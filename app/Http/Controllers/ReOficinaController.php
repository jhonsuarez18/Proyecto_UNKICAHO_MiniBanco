<?php

namespace App\Http\Controllers;

use App\reOficina;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class ReOficinaController extends Controller
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
        try{
            DB::transaction(function () use ($request) {
                $ofic=New reOficina();

                $ofic->pId=$request->idplaz;
                $ofic->oNombre=$request->nomofic;
                $ofic->oUsuReg = Auth::user()->id;
                $ofic->oFecCrea = UtilController::fecha();
                $ofic->save();
            });
            //reOficina::created($request->all());
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ReOficinaController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reOficina  $reOficina
     * @return \Illuminate\Http\Response
     */
    public function show(reOficina $reOficina)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reOficina  $reOficina
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            DB::transaction(function () use($request){
                $ofic= reOficina::findOrfail($request->idofic);
                $ofic->pId=$request->idplaz;
                $ofic->oNombre=$request->nomofic;
                $ofic->oUsuReg = Auth::user()->id;
                $ofic->oFecCrea = UtilController::fecha();
                $ofic->save();
            });
            //reOficina::findOrfail($id)->update($request->all());
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReOficinaController","edit");
            return response()->json(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reOficina  $reOficina
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reOficina $reOficina)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reOficina  $reOficina
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $ofic=reOficina::findOrfail($id);
                ($ofic->oEst === 1) ? $ofic->oEst = 0 : $ofic->oEst = 1;
                $ofic->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReOficinaController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getOfic()
    {
        return datatables::of(reOficina::join('re_plazo','re_oficina.pId', '=', 're_plazo.pId')
            ->select('re_plazo.pCantDia as pCantDia','re_oficina.oId as oId','re_oficina.oNombre as oNombre',DB::raw("DATE_FORMAT(re_oficina.oFecCrea,'%d-%m-%Y') as oFecCrea"),'re_oficina.oUsuReg as oUsuReg','re_oficina.oEst as oEst')
            ->orderby('re_oficina.oFecCrea','desc')->get())->make(true);
    }
    public function getOficEdit($id)
    {
        Return reOficina::where('oId','=',$id)->first();
    }
    public function validarOfic($des)
    {
        $ofic = reOficina::where(['oNombre' => $des])->select('oId','oNombre','oEst')->get();
        return response()->json(array('error' => 0, 'ofic' => $ofic));
    }
    public function getOficAct(){
        try {
            $ofic= reOficina::where('oEst','=','1')->get();
            return response()->json(array('error' => 0,'ofic'=>$ofic));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ReOficinaController","getPermisos");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
