<?php

namespace App\Http\Controllers;

use App\ALTipMat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TipoMaterialController extends Controller
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
                $tipom=New ALTipMat();

                $tipom->tmDesc=$request->destipm;
                $tipom->tmFecCrea = UtilController::fecha();
                $tipom->tmUsuReg = Auth::user()->id;
                $tipom->save();
            });

            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"TipoMaterialController","store");
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
    public function edit(Request $request)
    {
        //AGREGADO 17-12-2020
        try{
            DB::transaction(function() use($request){
                $tipm=ALTipMat::findOrfail($request->idtipm);
                $tipm->tmDesc=$request->desctipm;
                $tipm->tmFecCrea=UtilController::fecha();
                $tipm->tmUsuReg=Auth::User()->id;
                $tipm->save();

            });

            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"TipoMaterialController","edit");
            return response()->json(array('error' => $e->getMessage()));
        }
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
        //AGREGADO 17-12-2020
        try {
            DB::transaction(function () use ($id) {
                $tipm = ALTipMat::findOrFail($id);
                ($tipm->tmEst === 1) ? $tipm->tmEst = 0 : $tipm->tmEst = 1;
                $tipm->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"TipoMaterialController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getTipoMate()
    {
        return Datatables::of(ALTipMat::join('users','tmUsuReg', '=', 'users.id')
            ->select(DB::raw("tmId,tmDesc, DATE_FORMAT(tmFecCrea,'%d-%m-%Y') AS tmFecCrea, users.name as uname,tmEst"))->orderBy('tmFecCrea'))->make(true);
    }
    public function ValidarTipoMaterial($tip)
    {
        $tipom = ALTipMat::where(['tmDesc' => $tip])->select('tmId','tmDesc','tmEst')->get();
        return response()->json(array('error' => 0, 'tipm' => $tipom));
    }
    public function getTipMEdit($id)
    {
        Return ALTipMat::where('tmId','=',$id)->first();
    }
    public function getTipM()
    {
        $tipm=ALTipMat::where('tmEst','=','1')->get();
        return response()->json(array('error'=>0,'tipm'=>$tipm));
    }
}
