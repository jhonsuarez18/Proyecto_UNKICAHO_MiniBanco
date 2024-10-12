<?php

namespace App\Http\Controllers;

use App\Grado_Seccion;
use App\UbicacionModel;
use Illuminate\Http\Request;
use vakata\database\Exception;

class GradoSeccionController extends Controller
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
    public function obtenerSeccion($idga)
    {

        try {
            $result = Grado_Seccion::obtenerGradoSecc($idga);
            return response()->json(array('error' => 0, 'gradsecc' => $result));

        } catch (Exception $e) {
            return response()->json(array('error' => $e));

        }
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
