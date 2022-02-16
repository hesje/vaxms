<?php

namespace App\Http\Controllers;

use App\Models\Vaccinations;
use App\Http\Requests\StoreVaccinationsRequest;
use App\Http\Requests\UpdateVaccinationsRequest;

class VaccinationsController extends Controller
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
     * @param  \App\Http\Requests\StoreVaccinationsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreVaccinationsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vaccinations  $vaccinations
     * @return \Illuminate\Http\Response
     */
    public function show(Vaccinations $vaccinations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vaccinations  $vaccinations
     * @return \Illuminate\Http\Response
     */
    public function edit(Vaccinations $vaccinations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVaccinationsRequest  $request
     * @param  \App\Models\Vaccinations  $vaccinations
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateVaccinationsRequest $request, Vaccinations $vaccinations)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vaccinations  $vaccinations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vaccinations $vaccinations)
    {
        //
    }
}
