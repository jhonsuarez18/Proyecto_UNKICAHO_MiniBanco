<?php

namespace App\Http\Controllers;

use App\VTipoCombustible;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class VTipoCombustibleController extends Controller
{
    public function getTipComb(){
        return VTipoCombustible::all();
    }
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
                $tipc=New VTipoCombustible();

                $tipc->tCDesc=$request->desctipcomb;
                $tipc->tCUsuReg = Auth::user()->id;
                $tipc->tCFecCrea = UtilController::fecha();
                $tipc->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"VTipoCombustibleController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VTipoCombustible  $vTipoCombustible
     * @return \Illuminate\Http\Response
     */
    public function show(VTipoCombustible $vTipoCombustible)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VTipoCombustible  $vTipoCombustible
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            DB::transaction(function () use($request){
                $tipc= VTipoCombustible::findOrfail($request->idtipcomb);
                $tipc->tCDesc=$request->desctipcomb;
                $tipc->tCUsuReg = Auth::user()->id;
                $tipc->tCFecCrea = UtilController::fecha();
                $tipc->save();
            });
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VTipoCombustibleController","edit");
            return response()->json(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VTipoCombustible  $vTipoCombustible
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VTipoCombustible $vTipoCombustible)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VTipoCombustible  $vTipoCombustible
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $tipc=VTipoCombustible::findOrfail($id);
                ($tipc->tCEst === 1) ? $tipc->tCEst = 0 : $tipc->tCEst = 1;
                $tipc->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VTipoCombustibleController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getTipCombs()
    {
        try{
            return Datatables::of(VTipoCombustible::join('users','tCUsuReg', '=', 'users.id')
                ->select('tCId','tCDesc','users.name as uname','tCEst',
                    DB::raw("DATE_FORMAT(tCFecCrea,'%d-%m-%Y') AS tCFecCrea")))->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VTIpoCombustibleController","getTipCombs");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function geTipCombEdit($id)
    {
        try{
            $tipcomb= VTipoCombustible::where('tCId','=',$id)->first();
            return response()->json(array('error' => 0, 'tipcomb' => $tipcomb));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VTipoCombustibleController","geTipCombEdit");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getTipCombsAct()
    {
        try{
            $tipcomb= VTipoCombustible::where('tCEst','=',1)->get();
            return response()->json(array('error' => 0, 'tipcomb' =>  $tipcomb));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VTipoCombustibleController","getTipCombsAct");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
