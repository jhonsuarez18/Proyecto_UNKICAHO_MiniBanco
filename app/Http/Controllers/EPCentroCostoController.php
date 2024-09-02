<?php

namespace App\Http\Controllers;

use App\EPCentroCosto;
use Illuminate\Http\Request;

class EPCentroCostoController extends Controller
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
     * @param \App\EPCentroCosto $ePCentroCosto
     * @return \Illuminate\Http\Response
     */
    public function show(EPCentroCosto $ePCentroCosto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\EPCentroCosto $ePCentroCosto
     * @return \Illuminate\Http\Response
     */
    public function edit(EPCentroCosto $ePCentroCosto)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\EPCentroCosto $ePCentroCosto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EPCentroCosto $ePCentroCosto)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\EPCentroCosto $ePCentroCosto
     * @return \Illuminate\Http\Response
     */
    public function destroy(EPCentroCosto $ePCentroCosto)
    {
        //
    }

    public function getCentroCosto(Request $request)
    {
        $term = $request->input('term');

        return EPCentroCosto::getCentroCosto("$term");
    }

    public function getAll()
    {
        try {
            return  EPCentroCosto::getAllyear();
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "EPCentroCostoController", "getAll");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
