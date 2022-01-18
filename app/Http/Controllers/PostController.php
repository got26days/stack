<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Http\Requests\StorePostRequest;
use App\Http\Requests\UpdatePostRequest;
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
    public function index(Request $request)
    {
        $all_posts = cache()->remember('all_posts', 60 * 60 * 24, function () {
            return Post::count();
        });
        // echo Cache::set('item', 'asdsa');


        // echo Cache::get('item');

        $tab = 'newest';

        if ($request['tab']) {
            $tab = $request['tab'];
        }


        $posts = cache()->remember('posts' . $tab, 60 * 60 * 24, function () use ($tab) {
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
