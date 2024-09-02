<?php

namespace App\Http\Controllers;

use App\reObservacion;
use Illuminate\Http\Request;

class ReObservacionController extends Controller
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
     * @param \App\reObservacion $reObservacion
     * @return \Illuminate\Http\Response
     */
    public function show(reObservacion $reObservacion)
    {
        //
    }

    public function getObservacion($rId)
    {
        try {
            $obs = new reObservacion();

            return response()->json(array('error' => 0,'obs'=>$obs->getObservacion($rId)));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReObservacionController", "getObservacion");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\reObservacion $reObservacion
     * @return \Illuminate\Http\Response
     */
    public
    function edit(reObservacion $reObservacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\reObservacion $reObservacion
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, reObservacion $reObservacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\reObservacion $reObservacion
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(reObservacion $reObservacion)
    {
        //
    }
}
