<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
use App\Models\PostTag;
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


        // $posts = cache()->remember(request()->getRequestUri(), 60 * 60 * 24, function () use ($tab, $tags) {
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

            // foreach ($tags as $tag) {
            //     $posts->whereHas('tagsRelationship', function ($q) use ($tag) {
            //         $q->where('tag_id', $tag->id);
            //     });
            // }

            $count = count($tags);

            $tagIds = array_column($tags, 'id');

            $postTag = PostTag::whereIn('tag_id', $tagIds)->pluck('post_id')->toArray();

            $ids = [];

            $postTag = array_count_values($postTag);

            foreach ($postTag as $k => $pt) {
                if ($pt >= $count) {
                    $ids[] = $k;
                }
            }

            $posts = $posts->where(function ($query) use ($ids) {
                foreach ($ids as $s => $i) {
                    if ($s == 0) {
                        $query->where('id', $i);
                    } else {
                        $query->orWhere('id',  $i);
                    }
                }
            });
        }

        if ($tab == 'newest') {
            $posts = $posts->latest();
        }

        if ($tab == 'active') {
            $posts = $posts->where('closed_date', null)->latest();
        }

        // return $posts->limit(40)->get();
        // });

        $posts = $posts->limit(40)->get();


        return view('pages.posts', compact('posts', 'tab', 'tags'));
    }

    public function tagged(Request $request, $tags)
    {
        $pieces = explode(" ", $tags);

        if (count($pieces) < 1) {
            abort(404);
        }

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
