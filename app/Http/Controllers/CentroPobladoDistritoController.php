<?php

namespace App\Http\Controllers;

use App\CentropobladoDistrito;
use Illuminate\Http\Request;

class CentroPobladoDistritoController extends Controller
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
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
   static function getExistcPD($iddist,$idcentp)
    {
        try {
            /*$centpd= CentropobladoDistrito::where('idCentroPoblado','=',$idcentp)
                ->where('idDistrito','=',$iddist)->select('*')->get();*/
           return CentropobladoDistrito::where(['idCentroPoblado'=>$idcentp,'idDistrito'=>$iddist])
                ->select('*')->get();
            //return response()->json(array('error' => 0, 'centpd' => $centpd));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"CentroPobladoDistritoController","getExistcPD");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
