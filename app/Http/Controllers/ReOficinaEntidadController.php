<?php

namespace App\Http\Controllers;

use App\reDocumento;
use App\reOficinaEntidad;
use App\reUsuOfi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class ReOficinaEntidadController extends Controller
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

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reOficinaEntidad  $reOficinaEntidad
     * @return \Illuminate\Http\Response
     */
    public function show(reOficinaEntidad $reOficinaEntidad)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reOficinaEntidad  $reOficinaEntidad
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reOficinaEntidad  $reOficinaEntidad
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reOficinaEntidad $reOficinaEntidad)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reOficinaEntidad  $reOficinaEntidad
     * @return \Illuminate\Http\Response
     */
    public function destroy(reOficinaEntidad $reOficinaEntidad)
    {

    }
    public function getOficEnt(Request $request,$id)
    {
        $term = $request->input('term');
        return reOficinaEntidad::getOficEnt($term,$id);
    }
}
