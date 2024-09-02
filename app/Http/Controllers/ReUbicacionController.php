<?php

namespace App\Http\Controllers;

use App\reUbicacion;
use Illuminate\Http\Request;
use vakata\database\Exception;

class ReUbicacionController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reUbicacion  $reUbicacion
     * @return \Illuminate\Http\Response
     */
    public function show(reUbicacion $reUbicacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reUbicacion  $reUbicacion
     * @return \Illuminate\Http\Response
     */
    public function edit(reUbicacion $reUbicacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reUbicacion  $reUbicacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reUbicacion $reUbicacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reUbicacion  $reUbicacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(reUbicacion $reUbicacion)
    {
        //
    }
    function obtenerUbicaciones($idref)
    {
        try {
            $result = reUbicacion::getUbicaciones($idref);
            $result1 = reUbicacion:: ObtenerUbicacionesref($idref);
            //dd($result,$result1);
            return response()->json(array('error' => 0, 'result' => $result,'result1'=>$result1));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

}
