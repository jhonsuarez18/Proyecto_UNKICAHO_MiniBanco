<?php

namespace App\Http\Controllers;

use App\ViTipoDoc;
use App\ViTipoGasto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class ViTipoGastoController extends Controller
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
    public function getGasto(){
        return response()->json(array('error'=>0,'tg'=>ViTipoGasto::all()));
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
            DB::transaction(function () use ($request) {
                $tipgas=New ViTipoGasto();
                $tipgas->tGDesc=$request->desctipg;
                $tipgas->tGUsuReg = Auth::user()->id;
                $tipgas->tGFecCrea = UtilController::fecha();
                $tipgas->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ViTipoGastoController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ViTipoGasto  $viTipoGasto
     * @return \Illuminate\Http\Response
     */
    public function show(ViTipoGasto $viTipoGasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ViTipoGasto  $viTipoGasto
     * @return \Illuminate\Http\Response
     */
    public function edit($idtipg)
    {
        try{
            Return ViTipoGasto::where('tGId','=',$idtipg)->first();
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViTipoGastoController","edit");
            return response(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ViTipoGasto  $viTipoGasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            DB::transaction(function () use ($request) {
                $tipgas= ViTipoGasto::findOrfail($request->idtipgas);
                $tipgas->tGDesc=$request->desctipg;
                $tipgas->tGUsuReg = Auth::user()->id;
                $tipgas->tGFecCrea = UtilController::fecha();
                $tipgas->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ViTipoGastoController","update");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ViTipoGasto  $viTipoGasto
     * @return \Illuminate\Http\Response
     */
    public function destroy($idtipg)
    {
        try{
            DB::transaction(function() use($idtipg){
                $tipgas=ViTipoGasto::findOrfail($idtipg);
                ($tipgas->tGEst === 1) ? $tipgas->tGEst = 0 : $tipgas->tGEst = 1;
                $tipgas->tGUsuMod = Auth::user()->id;
                $tipgas->tGFecmod = UtilController::fecha();
                $tipgas->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViTipoGastoController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getTipGas()
    {
        try{
            return datatables::of(ViTipoGasto::select('tGId','tGDesc',
                DB::raw("DATE_FORMAT(tGFecCrea,'%d-%m-%Y') as tGFecCrea"),'tGEst')
                ->orderby('tGFecCrea','desc')->get())->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViTipoGastoController","getTipGas");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function validarTipGas($des)
    {
        try{
            $tipgas = ViTipoGasto::where(['tGDesc' => $des])->select('tGId','tGDesc','tGEst')->get();
            return response()->json(array('error' => 0, 'tipgas' => $tipgas));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViTipoGastoController","validarTipGas");
            return response(array('error'=>$e->getMessage()));
        }

    }
    public function getTipGasAct()
    {
        try{
            $tipgas=ViTipoGasto::where(['tGEst'=>1])->select('tGId','tGDesc','tGEst')->get();
            return response()->json(array('error' => 0, 'tipgas' => $tipgas));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViTipoGastoController","getTipGasAct");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
