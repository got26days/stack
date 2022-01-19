<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
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
        $all_posts = cache()->remember('all_posts', 60 * 60 * 24, function () {
            return Post::count();
        });

        $tab = 'newest';

        if ($request['tab']) {
            $tab = $request['tab'];
        }

        $page = 1;

        if ($request['page']) {
            $page = $request['page'];
        }

        $posts = cache()->remember('posts' . $tab . $page, 60 * 60 * 24, function () use ($tab) {
            $posts = Post::query();

            if ($tab == 'week') {
                $posts->where('created_at', '>=', now()->subDays(80));
            }

            if ($tab == 'month') {
                $posts->where('created_at', '>=', now()->subDays(150));
            }

            if ($tab == 'hot') {
                $posts = $posts->orderBy('score', 'DESC');
            }

            if ($tab == 'newest') {
                $posts = $posts->latest();
            }

            return $posts->paginate(20);
        });


        return view('pages.posts', compact('posts', 'tab', 'all_posts'));
    }

    public function tagged(Request $request, $tags)
    {
        $pieces = explode(" ", $tags);

        $tag_ids = [];
        $tag_name = [];

        // foreach ($pieces as $piece) {
        //     $tag = Tag::where('tag_name', $piece)->first();
        //     if ($tag) {
        //         $tag_ids[] = $tag->id;
        //         $tag_name[] = '<' . $tag->tag_name . '>';
        //     }
        // }

        if (count($tag_ids) < 1) {
            abort(404);
        }


        $tags = implode(' ', $tag_ids);
        $tag_name = implode($tag_name);
        // $tags = cache()->remember('tags_' . $tags, 60 * 60 * 24, function () use ($tag_ids) {
        //     return Tag::whereIn('id', array_values($tag_ids))->get();
        // });

        $this->index($request, $tags);
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
