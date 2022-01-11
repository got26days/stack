<?php

namespace App\Http\Controllers;

use App\Models\PostLink;
use App\Http\Requests\StorePostLinkRequest;
use App\Http\Requests\UpdatePostLinkRequest;

class PostLinkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Http\Requests\StorePostLinkRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostLinkRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostLink  $postLink
     * @return \Illuminate\Http\Response
     */
    public function show(PostLink $postLink)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostLink  $postLink
     * @return \Illuminate\Http\Response
     */
    public function edit(PostLink $postLink)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostLinkRequest  $request
     * @param  \App\Models\PostLink  $postLink
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostLinkRequest $request, PostLink $postLink)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostLink  $postLink
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostLink $postLink)
    {
        //
    }
}
