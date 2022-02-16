<?php

namespace App\Http\Controllers;

use App\Models\Child;
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
     * @param  \App\Models\Child  $children
     * @return \Illuminate\Http\Response
     */
    public function show(Child $children)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Child  $children
     * @return \Illuminate\Http\Response
     */
    public function edit(Child $children)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateChildrenRequest  $request
     * @param  \App\Models\Child  $children
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateChildrenRequest $request, Child $children)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Child  $children
     * @return \Illuminate\Http\Response
     */
    public function destroy(Child $children)
    {
        //
    }
}
