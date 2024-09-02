<?php

namespace App\Http\Controllers;

use App\ViTipoDocGast;
use App\ViGasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class ViTipoDocGastController extends Controller
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

    public function getComp($idGas)
    {
        $comp = new ViGasto();
        return response()->json(array('error' => 0, 'tc' => $comp->tipDoc($idGas)));
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
        try{
            DB::transaction(function () use ($request) {
                $docgas=New ViTipoDocGast();
                $docgas->tDId=$request->idtipd;
                $docgas->gId=$request->idgas;
                $docgas->tDGUsuReg = Auth::user()->id;
                $docgas->tDGFecCrea = UtilController::fecha();
                $docgas->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ViTipoDocGastController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ViTipoDocGast $viTipoDocGast
     * @return \Illuminate\Http\Response
     */
    public function show(ViTipoDocGast $viTipoDocGast)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ViTipoDocGast $viTipoDocGast
     * @return \Illuminate\Http\Response
     */
    public function edit($idtipdg)
    {
        try{
            Return ViTipoDocGast::where('tDGId','=',$idtipdg)->first();
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViTipoDocGastController","edit");
            return response(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ViTipoDocGast $viTipoDocGast
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            DB::transaction(function () use ($request) {
                $docgas= ViTipoDocGast::findOrfail($request->idtdg);
                $docgas->tDId=$request->idtipd;
                $docgas->gId=$request->idgas;
                $docgas->tDGUsuReg = Auth::user()->id;
                $docgas->tDGFecCrea = UtilController::fecha();
                $docgas->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ViTipoDocGastController","update");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ViTipoDocGast $viTipoDocGast
     * @return \Illuminate\Http\Response
     */
    public function destroy($idtipdg)
    {
        try{
            DB::transaction(function() use($idtipdg){
                $docgas=ViTipoDocGast::findOrfail($idtipdg);
                ($docgas->tDGEst === 1) ? $docgas->tDGEst  = 0 : $docgas->tDGEst  = 1;
                $docgas->tDGUsuMod = Auth::user()->id;
                $docgas->tDGFecmod = UtilController::fecha();
                $docgas->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViTipoDocGastController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getTipDG()
    {
        try{
            return datatables::of(ViTipoDocGast::getTipDG())->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViTipoDocGastController","getTipDG");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function validarTipDG($des)
    {
        try{
            $gas = ViTipoDocGast::where(['gDesc' => $des])->select('gId','gDesc','gEst')->get();
            return response()->json(array('error' => 0, 'gast' => $gas));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViTipDocGastController","validarTipDG");
            return response(array('error'=>$e->getMessage()));
        }

    }
}
