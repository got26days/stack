<?php

namespace App\Http\Controllers;

use App\Models\AnotherPost;
use App\Http\Requests\StoreAnotherPostRequest;
use App\Http\Requests\UpdateAnotherPostRequest;

class AnotherPostController extends Controller
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
     * @param  \App\Http\Requests\StoreAnotherPostRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnotherPostRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AnotherPost  $anotherPost
     * @return \Illuminate\Http\Response
     */
    public function show(AnotherPost $anotherPost)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AnotherPost  $anotherPost
     * @return \Illuminate\Http\Response
     */
    public function edit(AnotherPost $anotherPost)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnotherPostRequest  $request
     * @param  \App\Models\AnotherPost  $anotherPost
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAnotherPostRequest $request, AnotherPost $anotherPost)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AnotherPost  $anotherPost
     * @return \Illuminate\Http\Response
     */
    public function destroy(AnotherPost $anotherPost)
    {
        //
    }
}
