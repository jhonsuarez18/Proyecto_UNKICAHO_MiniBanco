<?php

namespace App\Http\Controllers;

use App\rePlazo;
use App\reTipSeguro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class RePlazoController extends Controller
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
                $plaz=New rePlazo();

                $plaz->pCantDia=$request->cantd;
                $plaz->pUsuReg = Auth::user()->id;
                $plaz->pFecCrea = UtilController::fecha();
                $plaz->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"RePlazoController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\rePlazo  $rePlazo
     * @return \Illuminate\Http\Response
     */
    public function show(rePlazo $rePlazo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rePlazo  $rePlazo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            DB::transaction(function () use($request){
                $plaz=rePlazo::findOrfail($request->idplaz);
                $plaz->pCantDia=$request->cantd;
                $plaz->pFecCrea=UtilController:: fecha();
                $plaz->pUsuReg=Auth::user()->id;
                $plaz->save();
            });
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"RePlazoController","edit");
            return response()->json(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\rePlazo  $rePlazo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rePlazo $rePlazo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rePlazo  $rePlazo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $plaz=rePlazo::findOrfail($id);
                ($plaz->pEst === 1) ? $plaz->pEst = 0 : $plaz->pEst = 1;
                $plaz->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"RePlazoController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getPlazos()
    {
        return Datatables::of(rePlazo::join('users','re_plazo.pUsuReg', '=', 'users.id')
            ->select('pId','pCantDia',DB::raw("DATE_FORMAT(pFecCrea,'%d-%m-%Y') AS pFecCrea"),'users.name as uname','pEst'))->make(true);
    }
    public function getPlazoEdit($id)
    {
        Return rePlazo::where('pId','=',$id)->first();
    }
    public function validarPlazo($cant)
    {
        $plaz = rePlazo::where(['pCantDia' => $cant])->select('pId','pCantDia','pEst')->get();
        return response()->json(array('error' => 0, 'plaz' => $plaz));
    }
    public function getPlazosOfic()
    {
        $plaz=rePlazo::where('pEst','=','1')->get();
        return response()->json(array('error'=>0,'plaz'=>$plaz));
    }
}
