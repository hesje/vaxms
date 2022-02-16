<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Http\Requests\StoreChildrenRequest;
use App\Http\Requests\UpdateChildrenRequest;

class ChildrenController extends Controller
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
     * @param  \App\Http\Requests\StoreChildrenRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreChildrenRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Http\Response
     */
    public function show(Children $children)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Http\Response
     */
    public function edit(Children $children)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChildrenRequest  $request
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChildrenRequest $request, Children $children)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Children  $children
     * @return \Illuminate\Http\Response
     */
    public function destroy(Children $children)
    {
        //
    }
}
