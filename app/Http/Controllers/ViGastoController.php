<?php

namespace App\Http\Controllers;

use App\ViGasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class ViGastoController extends Controller
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

    public function getGasto($id){
        return response()->json(array('error'=>0,'tga'=>ViGasto::where('tGId',$id)->get()));
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
                $gas=New ViGasto();
                $gas->tGId=$request->idtipg;
                $gas->gDesc=$request->descgast;
                $gas->gCosDia=$request->cosdia;
                $gas->gUsuReg = Auth::user()->id;
                $gas->gFecCrea = UtilController::fecha();
                $gas->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ViGastoController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ViGasto  $viGasto
     * @return \Illuminate\Http\Response
     */
    public function show(ViGasto $viGasto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ViGasto  $viGasto
     * @return \Illuminate\Http\Response
     */
    public function edit($idgast)
    {
        try{
            Return ViGasto::where('gId','=',$idgast)->first();
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViGastoController","edit");
            return response(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ViGasto  $viGasto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ViGasto $viGasto)
    {
        try{
            DB::transaction(function () use ($request) {
                $gas= ViGasto::findOrfail($request->idgast);
                $gas->tGId=$request->idtipg;
                $gas->gDesc=$request->descgas;
                $gas->gCosDia=$request->cosdia;
                $gas->gUsuMod = Auth::user()->id;
                $gas->gFecmod = UtilController::fecha();
                $gas->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ViGastoController","update");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ViGasto  $viGasto
     * @return \Illuminate\Http\Response
     */
    public function destroy($idgas)
    {
        try{
            DB::transaction(function() use($idgas){
                $gas=ViGasto::findOrfail($idgas);
                ($gas->gEst === 1) ? $gas->gEst = 0 : $gas->gEst = 1;
                $gas->gUsuMod = Auth::user()->id;
                $gas->gFecmod = UtilController::fecha();
                $gas->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViGastoController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getGastos()
    {
        try{
            return datatables::of(ViGasto::getGastos())->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViGastoController","getGastos");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function validarGasto($des)
    {
        try{
            $gas = ViGasto::where(['gDesc' => $des])->select('gId','gDesc','gEst')->get();
            return response()->json(array('error' => 0, 'gast' => $gas));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViGastoController","validarGasto");
            return response(array('error'=>$e->getMessage()));
        }

    }
}
