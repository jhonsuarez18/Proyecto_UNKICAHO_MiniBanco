<?php

namespace App\Http\Controllers;

use App\reEstPaciente;
use App\reTipPersonal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class ReTipPersonalController extends Controller
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
                $tipp=New reTipPersonal();

                $tipp->tPDescripcion=$request->destipp;
                $tipp->tPAbreviatura=$request->abretipp;
                $tipp->tPUsuReg = Auth::user()->id;
                $tipp->tPFecCrea = UtilController::fecha();
                $tipp->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ReTipPersonalController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reTipPersonal  $reTipPersonal
     * @return \Illuminate\Http\Response
     */
    public function show(reTipPersonal $reTipPersonal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reTipPersonal  $reTipPersonal
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            DB::transaction(function () use($request){
                $tipp= reTipPersonal::findOrfail($request->idtipp);
                $tipp->tPDescripcion=$request->destipp;
                $tipp->tPAbreviatura=$request->abretipp;
                $tipp->tPFecCrea=UtilController:: fecha();
                $tipp->tPUsuReg=Auth::user()->id;
                $tipp->save();
            });
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReTipPersonalController","edit");
            return response()->json(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reTipPersonal  $reTipPersonal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reTipPersonal $reTipPersonal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reTipPersonal  $reTipPersonal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $tipp=reTipPersonal::findOrfail($id);
                ($tipp->tPEst === 1) ? $tipp->tPEst = 0 : $tipp->tPEst = 1;
                $tipp->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReTipPersonalController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getTipP()
    {
        return Datatables::of(reTipPersonal::join('users','re_tip_personal.tPUsuReg', '=', 'users.id')
            ->select('tPId','tPDescripcion','tPAbreviatura',DB::raw("DATE_FORMAT(tPFecCrea,'%d-%m-%Y') AS tPFecCrea"),'users.name as uname','tPEst'))->make(true);
    }
    public function getTipPEdit($id)
    {
        Return reTipPersonal::where('tPId','=',$id)->first();
    }
    public function validarTipP($des)
    {
        $tipp = reTipPersonal::where(['tPDescripcion' => $des])->select('tPId','tPDescripcion','tPEst')->get();
        return response()->json(array('error' => 0, 'tipp' => $tipp));
    }
    public function getTipoPer()
    {
        try{
            $tipp=reTipPersonal::where('tPEst','=','1')->get();
            return response()->json(array('error'=>0,'tipp'=>$tipp));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReTipPersonalController","getTipoPer");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
