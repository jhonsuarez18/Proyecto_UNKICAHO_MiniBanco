<?php

namespace App\Http\Controllers;

use App\epp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class EppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('intranet.Covid.mantenimientoTablasCovid');
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"EppController","index");
            return response()->json(array('error' => $e->getMessage()));
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
            DB::transaction(function () use ($request) {
                $epp=New epp();

                $epp->descripcion=$request->descripcion;
                $epp->usuReg = Auth::user()->id;
                $epp->fecCreacion = UtilController::fecha();
                $epp->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"EppController","store");
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
                $epp= epp::findOrfail($request->idepp);
                $epp->descripcion=$request->descripcion;
                $epp->usuReg = Auth::user()->id;
                $epp->fecCreacion = UtilController::fecha();
                $epp->save();
            });
            return response()->json(array('error'=>0));
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(),"EppController","update");
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
                $epp=epp::findOrfail($id);
                ($epp->estado === 1) ? $epp->estado = 0 : $epp->estado = 1;
                $epp->save();
            });
            return response(array('error'=>0));
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(),"EppController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getEppss()
    {
        try{
            return Datatables::of(epp::join('users','usuReg', '=', 'users.id')
                ->select('idEpp','descripcion','users.name as uname','epp.estado',
                    DB::raw("DATE_FORMAT(fecCreacion,'%d-%m-%Y') AS fecCreacion")))->make(true);
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(),"EppController","getEppss");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getEppEdit($id)
    {
        try{
            $epp= epp::where('idEpp','=',$id)->first();
            return response()->json(array('error' => 0, 'epp' => $epp));
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(),"EppController","getEppEdit");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
