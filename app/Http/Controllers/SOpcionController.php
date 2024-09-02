<?php

namespace App\Http\Controllers;

use App\SOpcion;
use Illuminate\Http\Request;

class SOpcionController extends Controller
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


    public function getOpc()
    {
        return SOpcion::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\SOpcion $sOpcion
     * @return \Illuminate\Http\Response
     */
    public function show(SOpcion $sOpcion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\SOpcion $sOpcion
     * @return \Illuminate\Http\Response
     */
    public function edit(SOpcion $sOpcion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\SOpcion $sOpcion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SOpcion $sOpcion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\SOpcion $sOpcion
     * @return \Illuminate\Http\Response
     */
    public function destroy(SOpcion $sOpcion)
    {
        //
    }
}
