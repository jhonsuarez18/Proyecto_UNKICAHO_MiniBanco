<?php

namespace App\Http\Controllers;

use App\EntregaEpp;
use App\epp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class EntregaEppController extends Controller
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
    public function update(Request $request)
    {
        try{
            DB::transaction(function () use($request){
                $entreepp= EntregaEpp::findOrfail($request->ideepp);
                $entreepp->Cantidad=$request->cantidad;
                $entreepp->usuReg = Auth::user()->id;
                $entreepp->fecCreacion = UtilController::fecha();
                $entreepp->save();
            });
            return response()->json(array('error'=>0));
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(),"EntregaEppController","update");
            return response()->json(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $entreepp=EntregaEpp::findOrfail($id);
                ($entreepp->estado === 1) ? $entreepp->estado = 0 : $entreepp->estado = 1;
                $entreepp->save();
            });
            return response(array('error'=>0));
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(),"EntregaEppController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getEntregaEpps()
    {
        try{
            return Datatables::of(EntregaEpp::getEntregaEpps())->make(true);
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(),"EntregaEppController","getEntregaEpps");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getEntreEppEdit($id)
    {
        try{
            $eepp= EntregaEpp::where('idEntregaEpp','=',$id)->join('epp as e','e.idEpp','=','entregaepp.idEpp')
                ->select('idEntregaEpp','e.descripcion','entregaepp.Cantidad')->first();
            return response()->json(array('error' => 0, 'eepp' => $eepp));
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(),"EntregaEppController","getEntregaEppEdit");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
