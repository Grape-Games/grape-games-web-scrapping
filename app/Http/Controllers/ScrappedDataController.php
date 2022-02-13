<?php

namespace App\Http\Controllers;

use App\Models\ScrappedData;
use App\Http\Requests\StoreScrappedDataRequest;
use App\Http\Requests\UpdateScrappedDataRequest;

class ScrappedDataController extends Controller
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
     * @param  \App\Http\Requests\StoreScrappedDataRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreScrappedDataRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ScrappedData  $scrappedData
     * @return \Illuminate\Http\Response
     */
    public function show(ScrappedData $scrappedData)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ScrappedData  $scrappedData
     * @return \Illuminate\Http\Response
     */
    public function edit(ScrappedData $scrappedData)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateScrappedDataRequest  $request
     * @param  \App\Models\ScrappedData  $scrappedData
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateScrappedDataRequest $request, ScrappedData $scrappedData)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ScrappedData  $scrappedData
     * @return \Illuminate\Http\Response
     */
    public function destroy(ScrappedData $scrappedData)
    {
        //
    }
}
