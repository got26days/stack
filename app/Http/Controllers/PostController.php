<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\Answer;
use App\Models\PostTag;
use App\Models\PostTagSecond;
use App\Models\Question;
use App\Models\Seo;
use App\Models\Tag;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $tags = [])
    {

        $tab = 'newest';

        if ($request['tab']) {
            $tab = $request['tab'];
        }


        $posts = cache()->remember(request()->getRequestUri(), 60 * 60 * 24, function () use ($tab, $tags) {
            $posts = Question::query();

            if ($tab == 'week') {
                $posts->where('created_at', '>=', now()->subDays(80));
            }

            if ($tab == 'month') {
                $posts->where('created_at', '>=', now()->subDays(150));
            }

            if ($tab == 'hot') {
                $posts = $posts->orderBy('score', 'DESC');
            }

            if (count($tags) > 0) {
                ini_set('memory_limit', '16000M');
                $searchTags = $tags;
                usort($searchTags, fn ($a, $b) => -strcmp($a->count, $b->count));

                if (count($searchTags) <= 3) {

                    foreach ($searchTags as $tag) {

                        $posts->where(function ($query) use ($tag) {
                            $query->whereHas('tagsRelationship', function ($q) use ($tag) {
                                $q->where('tag_id', $tag->id);
                            })->orWhereHas('tagsRelationshipSecond', function ($q) use ($tag) {
                                $q->where('tag_id', $tag->id);
                            });
                        });
                    }
                } else {


                    $postTag = PostTag::where('tag_id', $searchTags[0]->id)->pluck('post_id')->toArray();
                    $postTagSecond = PostTagSecond::where('tag_id', $searchTags[0]->id)->pluck('post_id')->toArray();
                    $postTag = array_unique(array_merge($postTag, $postTagSecond));
                    foreach ($searchTags as $key => $tag) {
                        if ($key > 0) {
                            $pt = PostTag::where('tag_id', $tag->id)->pluck('post_id')->toArray();
                            $pts = PostTagSecond::where('tag_id', $tag->id)->pluck('post_id')->toArray();

                            $pt = array_unique(array_merge($pt, $pts));

                            $postTag = array_intersect($postTag, $pt);
                        }
                    }


                    $posts = $posts->where(function ($query) use ($postTag) {
                        foreach ($postTag  as $s => $i) {
                            if ($s == 0) {
                                $query->where('id', $i);
                            } else {
                                $query->orWhere('id',  $i);
                            }
                        }
                    });
                }
            }

            if ($tab == 'newest') {
                $posts = $posts->latest();
            }

            if ($tab == 'active') {
                $posts = $posts->where('closed_date', null)->latest();
            }

            return $posts->paginate(20);
        });

        foreach ($posts as $post) {
            $post->slug = Str::slug($post->title, '-');
        }

        $seo = Seo::where("page", "questions")->first();
        $seo_title = '';
        $seo_description = '';
        $seo_keywords = '';
        if ($seo) {
            $seo_title = $seo->seo_title;
            $seo_description = $seo->desription;
            $seo_keywords = $seo->seo_keywords;
        }

        return view('pages.posts', compact('posts', 'tab', 'tags', 'seo_title', 'seo_description', 'seo_keywords'));
    }

    public function tagged(Request $request, $tags = null)
    {

        if ($tags == null) {
            return $this->index($request);
        }

        $pieces = explode(" ", $tags);

        $tags = [];

        foreach ($pieces as $tag_name) {
            $tag = cache()->remember('tag_name' . $tag_name, 60 * 60 * 24, function () use ($tag_name) {
                return Tag::where('tag_name', $tag_name)->first();
            });

            if ($tag) {
                $tags[] = $tag;
            }
        }


        return $this->index($request, $tags);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question, Request $request)
    {

        $tab = 'active';

        if ($request['tab']) {
            $tab = $request['tab'];
        }

        $question->view_count = $question->view_count + 1;
        $question->save();

        $question->body = str_replace("<code>", "<code v-pre>", $question->body);


        $answers = Answer::where('parent_id', $question->id);

        if ($tab == 'active') {
            $answers->orderBy('created_at', 'DESC');
        }

        if ($tab == 'oldest') {
            $answers->orderBy('created_at');
        }

        if ($tab == 'votes') {
            $answers->orderBy('score', 'DESC');
        }

        $answers = $answers->paginate(5);


        $question->slug = Str::slug($question->title, '-');

        $seo_title = $question->seo_title ? $question->seo_title : $question->title;
        $seo_description = $question->seo_description ? $question->seo_description : $question->desription;
        $seo_keywords = $question->seo_keywords ? $question->seo_keywords : $question->tagsString;

        return view('pages.question', compact('question', 'answers', 'tab', 'seo_title', 'seo_description', 'seo_keywords'));
    }
}
