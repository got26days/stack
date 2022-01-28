<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\PostTag;
use App\Models\PostTagSecond;
use App\Models\Question;
use App\Models\Tag;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\DB;

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

                if (count($tags) <= 1) {

                    foreach ($tags as $tag) {

                        $posts->where(function ($query) use ($tag) {
                            $query->whereHas('tagsRelationship', function ($q) use ($tag) {
                                $q->where('tag_id', $tag->id);
                            })->orWhereHas('tagsRelationshipSecond', function ($q) use ($tag) {
                                $q->where('tag_id', $tag->id);
                            });
                        });
                    }
                } else {
                    ini_set('memory_limit', '8192M');

                    $postTag = PostTag::where('tag_id', $tags[0]->id)->pluck('post_id')->toArray();
                    $postTagSecond = PostTagSecond::where('tag_id', $tags[0]->id)->pluck('post_id')->toArray();
                    $postTag = array_merge($postTag, $postTagSecond);
                    foreach ($tags as $key => $tag) {
                        if ($key > 0) {
                            $pt = PostTag::where('tag_id', $tag->id)->pluck('post_id')->toArray();
                            $pts = PostTagSecond::where('tag_id', $tag->id)->pluck('post_id')->toArray();

                            $pt = array_merge($pt, $pts);

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


        return view('pages.posts', compact('posts', 'tab', 'tags'));
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
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostRequest  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostRequest $request, Post $post)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
