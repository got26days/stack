<?php

namespace App\Http\Controllers;

use App\Models\PostHistory;
use App\Http\Requests\StorePostHistoryRequest;
use App\Http\Requests\UpdatePostHistoryRequest;

class PostHistoryController extends Controller
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
     * @param  \App\Http\Requests\StorePostHistoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePostHistoryRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PostHistory  $postHistory
     * @return \Illuminate\Http\Response
     */
    public function show(PostHistory $postHistory)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PostHistory  $postHistory
     * @return \Illuminate\Http\Response
     */
    public function edit(PostHistory $postHistory)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePostHistoryRequest  $request
     * @param  \App\Models\PostHistory  $postHistory
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePostHistoryRequest $request, PostHistory $postHistory)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PostHistory  $postHistory
     * @return \Illuminate\Http\Response
     */
    public function destroy(PostHistory $postHistory)
    {
        //
    }
}
