<?php

namespace App\Http\Controllers;

use App\Sintoma;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class SintomaController extends Controller
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
                $sinto=New Sintoma();

                $sinto->descripcion=$request->descripcion;
                $sinto->usuReg = Auth::user()->id;
                $sinto->fecCreacion = UtilController::fecha();
                $sinto->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"SintomaController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
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
                $sinto= Sintoma::findOrfail($request->idsinto);
                $sinto->descripcion=$request->descripcion;
                $sinto->usuReg = Auth::user()->id;
                $sinto->fecCreacion = UtilController::fecha();
                $sinto->save();
            });
            return response()->json(array('error'=>0));
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(),"EppController","edit");
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
                $sinto=Sintoma::findOrfail($id);
                ($sinto->estado === 1) ? $sinto->estado = 0 : $sinto->estado = 1;
                $sinto->save();
            });
            return response(array('error'=>0));
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(),"SintomaController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getSintomas()
    {
        try{
            return Datatables::of(Sintoma::join('users','usuReg', '=', 'users.id')
                ->select('idSintoma','descripcion','users.name as uname','sintoma.estado',
                    DB::raw("DATE_FORMAT(fecCreacion,'%d-%m-%Y') AS fecCreacion")))->make(true);
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(),"SintomaController","getSintomas");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getSintomaEdit($id)
    {
        try{
            $sinto= Sintoma::where('idSintoma','=',$id)->first();
            return response()->json(array('error' => 0, 'sinto' => $sinto));
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(),"SintomaController","getSintomaEdit");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
