<?php

namespace App\Http\Controllers;

use App\reTipSeguro;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class ReTipSeguroController extends Controller
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
                $tips=New reTipSeguro();

                $tips->tSDescrip=$request->destips;
                $tips->tSUsuReg = Auth::user()->id;
                $tips->tSFecCrea = UtilController::fecha();
                $tips->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ReTipSeguroController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reTipSeguro  $reTipSeguro
     * @return \Illuminate\Http\Response
     */
    public function show(reTipSeguro $reTipSeguro)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reTipSeguro  $reTipSeguro
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            DB::transaction(function () use($request){
                $tips=reTipSeguro::findOrfail($request->idtips);
                $tips->tSDescrip=$request->desctips;
                $tips->tSFecCrea=UtilController:: fecha();
                $tips->tSUsuReg=Auth::user()->id;
                $tips->save();
            });
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReTipSeguroController","edit");
            return response()->json(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reTipSeguro  $reTipSeguro
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reTipSeguro $reTipSeguro)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reTipSeguro  $reTipSeguro
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $tips=reTipSeguro::findOrfail($id);
                ($tips->tSEst === 1) ? $tips->tSEst = 0 : $tips->tSEst = 1;
                $tips->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReTipSeguroController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getTipS()
    {
        return Datatables::of(reTipSeguro::join('users','re_tip_seguro.tSUsuReg', '=', 'users.id')
            ->select('tSId','tSDescrip',DB::raw("DATE_FORMAT(tSFecCrea,'%d-%m-%Y') AS tSFecCrea"),'users.name as uname','tSEst'))->make(true);
    }
    public function getTipSEdit($id)
    {
        Return reTipSeguro::where('tSId','=',$id)->first();
    }
    public function validartips($tip)
    {
        $tipos = reTipSeguro::where(['tSDescrip' => $tip])->select('tSId','tSDescrip','tSEst')->get();
        return response()->json(array('error' => 0, 'tips' => $tipos));
    }
    public function getTipSAct()
    {
        try{
            $tipsa=reTipSeguro::where('tSEst','=',1)->get();
            return response(array('error'=>0,'tipsa'=>$tipsa));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReTipSeguroController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
