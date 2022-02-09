<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Seo;
use Illuminate\Http\Request;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $tab = 'popular';

        if ($request['tab']) {
            $tab = $request['tab'];
        }

        $tags = cache()->remember(
            request()->getRequestUri(),
            60 * 60 * 24,
            function () use ($tab) {
                $tags = Tag::query();

                if ($tab == 'popular') {
                    $tags = $tags->orderBy('count', 'DESC');
                }

                if (
                    $tab == 'name'
                ) {
                    $tags = $tags->orderBy('tag_name');
                }

                if (
                    $tab == 'new'
                ) {
                    $tags = $tags->latest();
                }

                $tags = $tags->paginate(20);

                return $tags;
            }
        );

        $seo = Seo::where("page", "tags")->first();
        $seo_title = '';
        $seo_description = '';
        $seo_keywords = '';
        if ($seo) {
            $seo_title = $seo->seo_title;
            $seo_description = $seo->desription;
            $seo_keywords = $seo->seo_keywords;
        }

        return view('pages.tags', compact('tags', 'tab', 'seo_title', 'seo_description', 'seo_keywords'));
    }

    public function search(Request $request)
    {
        $tags = cache()->remember(request()->getRequestUri(), 60 * 60 * 24, function () use ($request) {
            $tags = Tag::where('tag_name', 'LIKE', "%{$request['tag']}%")
                ->where('tag_name', '!=', null);

            if ($request['tags_selected']) {
                foreach ($request['tags_selected'] as $key => $tag_selected) {
                    $tags->where('tag_name', '!=', $tag_selected);
                }
            }

            $tags = $tags->orderBy('count', 'DESC')->limit(5)->get();

            return $tags;
        });

        return $tags;
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
     * @param  \App\Http\Requests\StoreTagRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTagRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Tag $tag)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function edit(Tag $tag)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateTagRequest  $request
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateTagRequest $request, Tag $tag)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tag $tag)
    {
        //
    }
}
