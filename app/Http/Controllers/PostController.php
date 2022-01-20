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
    public function index(Request $request, $tags = null)
    {

        $tab = 'newest';

        if ($request['tab']) {
            $tab = $request['tab'];
        }

        $posts = cache()->remember(request()->getRequestUri(), 60 * 60 * 24, function () use ($tab, $tags) {
            $posts = Post::where('post_type_id', 1);

            if ($tab == 'week') {
                $posts->where('created_at', '>=', now()->subDays(80));
            }

            if ($tab == 'month') {
                $posts->where('created_at', '>=', now()->subDays(150));
            }

            if ($tab == 'hot') {
                $posts = $posts->orderBy('score', 'DESC');
            }


            if ($tags) {
                $posts = $posts->where('tags', 'LIKE', "%{$tags['names']}%");
            }

            if ($tab == 'newest') {
                $posts = $posts->latest();
            }

            if ($tab == 'active') {
                $posts = $posts->where('closed_date', null)->latest();
            }

            return $posts->paginate(20);
        });

        $selectedTags = [];
        if ($tags) {
            $selectedTags = $tags['array'];
        }

        return view('pages.posts', compact('posts', 'tab', 'tags', 'selectedTags'));
    }

    public function tagged(Request $request, $tags)
    {
        $old_pieces = explode(" ", $tags);

        if (count($old_pieces) < 1) {
            abort(404);
        }

        $pieces = $old_pieces;

        sort($pieces);


        $tags = [
            'names' => implode($tag_names),
            'array' => $old_pieces
        ];


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
