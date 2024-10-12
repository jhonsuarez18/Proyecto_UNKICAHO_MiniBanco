<?php

namespace App\Http\Controllers;

use App\Apoderado;
use App\Cliente;
use App\Persona;
use Illuminate\Http\Request;

class ApoderadoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vi = 1;
            return view('intranet.mantenimiento.agregarapoderado')->with(array('vi' => $vi));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ApoderadoController", "index");
            return response(array('error' => $e->getMessage()));
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
    function getApoderadoDni($dni)
    {

        try {
            $apoderado= Apoderado::getApoderadoDni($dni);
            //$person = Persona::buscarPersonaDni($dni);
            return response()->json(array('error' => 0,'apoderado'=>$apoderado));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"Cliente","getClienteDni");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getApoderados(){
        try{
            Return datatables(Apoderado::getApoderados())->make(true);
        } catch (\Exception $e) {
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
