<?php

namespace App\Http\Controllers;

use App\EPfuenteFinanciamiento;
use App\reReferencia;
use App\reRefPer;
use App\VCOcTCombust;
use App\VOrdenCompra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;

class VOrdenCompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return Datatables(VOrdenCompra::getOrdenCompras())->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VOrdenCompraController","index");
            return response(array('error'=>$e->getMessage()));
        }
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
        try{
            $occomb = json_decode($request->combus, true);
            DB::transaction(function () use ($request,$occomb) {
                $ordc=New VOrdenCompra();

                $ordc->fFId=$request->idfufi;
                $ordc->gId=$request->idgrif;
                $ordc->oNumOC=$request->numoc;
                $ordc->oCNumFact=$request->numfact;
                $ordc->oCUsuReg = Auth::user()->id;
                $ordc->oCFecCrea = UtilController::fecha();
                $ordc->save();
                $ocId= $ordc->oCId;

                for($i=0;$i<count($occomb);$i++){

                    $ordctc=New VCOcTCombust();

                    $ordctc->oCId=$ocId;
                    $ordctc->tCId=$occomb[$i][1];
                    $ordctc->cOTCant=$occomb[$i][2];
                    $ordctc->cOTUsuReg = Auth::user()->id;
                    $ordctc->cOTFecCrea = UtilController::fecha();
                    $ordctc->save();
                }
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"VOrdenCompraController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VOrdenCompra  $vOrdenCompra
     * @return \Illuminate\Http\Response
     */
    public function show(VOrdenCompra $vOrdenCompra)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VOrdenCompra  $vOrdenCompra
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $ordc= VOrdenCompra::where('oCId','=',$id)->first();
            return response()->json(array('error' => 0, 'ordc' => $ordc));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VOrdenCompraController","edit");
            return response(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VOrdenCompra  $vOrdenCompra
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            $occomb = json_decode($request->combus, true);
            DB::transaction(function () use ($request,$occomb) {
                $ordc= VOrdenCompra::findOrfail($request->idoc);

                $ordc->fFId=$request->idfufi;
                $ordc->gId=$request->idgrif;
                $ordc->oNumOC=$request->numoc;
                $ordc->oCNumFact=$request->numfact;
                $ordc->oCUsuReg = Auth::user()->id;
                $ordc->oCFecCrea = UtilController::fecha();
                $ordc->save();

                for($i=0;$i<count($occomb);$i++){
                    if($occomb[$i][3]==2){
                        $ordctc=New VCOcTCombust();
                        $ordctc->oCId=$request->idoc;
                        $ordctc->tCId=$occomb[$i][1];
                        $ordctc->cOTCant=$occomb[$i][2];
                        $ordctc->cOTUsuReg = Auth::user()->id;
                        $ordctc->cOTFecCrea = UtilController::fecha();
                        $ordctc->save();
                    }else{
                        $ordctc= VCOcTCombust::findOrfail($occomb[$i][4]);
                        $ordctc->oCId=$request->idoc;
                        $ordctc->tCId=$occomb[$i][1];
                        $ordctc->cOTCant=$occomb[$i][2];
                        $ordctc->cOTUsuReg = Auth::user()->id;
                        $ordctc->cOTFecCrea = UtilController::fecha();
                        $ordctc->cOTEst = $occomb[$i][3];
                        $ordctc->save();
                    }
                }
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"VOrdenCompraController","update");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VOrdenCompra  $vOrdenCompra
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
               $ordc=VOrdenCompra::findOrfail($id);
                ( $ordc->oCEst === 1) ?  $ordc->oCEst = 0 :  $ordc->oCEst = 1;
                $ordc->save();
                $yy=VCOcTCombust::where('oCId','=',$id)->get();
                //dd(count($yy));
                foreach ($yy as $oy) {
                    $ordcomb=VCOcTCombust::findOrfail($oy->cOTId);
                    ( $ordcomb->cOTEst === 1) ?  $ordcomb->cOTEst= 0 :  $ordcomb->cOTEst = 1;
                    $ordcomb->save();
                    //dd($oy->cOTCant);
                }

            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VOrdenCompraController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getordencompra()
    {
        try{
            return VOrdenCompra::where("oCEst","=","1")->get();
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VOrdenCompraController","getordencompra");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getOrdCompComb()
    {
        try{
            return VOrdenCompra::getOrdCComb();
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VOrdenCompraController","getordencompra");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function valNumoc($numoc)
    {

        try{
            $ordc = VOrdenCompra::where('oNumOC', $numoc)->get();
            return response()->json(array('error' => 0, 'ordc' => $ordc));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VOrdenCompraController","valNumoc");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
