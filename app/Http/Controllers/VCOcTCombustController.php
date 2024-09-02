<?php

namespace App\Http\Controllers;

use App\VCOcTCombust;
use App\VOrdenCompra;
use Illuminate\Http\Request;
use vakata\database\Exception;

class VCOcTCombustController extends Controller
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
     * @param  \App\VCOcTCombust  $vCOcTCombust
     * @return \Illuminate\Http\Response
     */
    public function show(VCOcTCombust $vCOcTCombust)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VCOcTCombust  $vCOcTCombust
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $ordcomb= VCOcTCombust::join('v_tipo_combustible as tc','v_c_oc_t_combust.tCId', '=', 'tc.tCId')
            ->where('oCId','=',$id)->get();
            return response()->json(array('error' => 0, 'ordcomb' => $ordcomb));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VCOcTCombustController","edit");
            return response(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VCOcTCombust  $vCOcTCombust
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VCOcTCombust $vCOcTCombust)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VCOcTCombust  $vCOcTCombust
     * @return \Illuminate\Http\Response
     */
    public function destroy(VCOcTCombust $vCOcTCombust)
    {
        //
    }
    public function getCotComb($id)
    {
        try{
            $ordcomb= VCOcTCombust::getSaldo($id);
            return response()->json(array('error' => 0, 'ordcomb' => $ordcomb));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VCOcTCombustController","edit");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getItemVal($id)
    {
        try{
            $ordcomb= VCOcTCombust::getItemVale($id);
            return response()->json(array('error' => 0, 'ordcomb' => $ordcomb));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VCOcTCombustController","getItemVal");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
