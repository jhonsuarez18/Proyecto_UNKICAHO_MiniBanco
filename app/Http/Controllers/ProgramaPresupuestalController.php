<?php

namespace App\Http\Controllers;

use App\EPProgramaPresupuestal;
use Illuminate\Http\Request;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class ProgramaPresupuestalController extends Controller
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
                $progpres=New EPProgramaPresupuestal();

                $progpres->pPCod=$request->codprogpres;
                $progpres->pPDesc=$request->descprogpres;
                $progpres->pPFecCrea = UtilController::fecha();
                $progpres->pPUsuReg = Auth::user()->id;
                $progpres->save();
            });

            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ProgramaPresupuestalController","store");
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
        try{
            DB::transaction(function() use($request){
              $progpres=EPProgramaPresupuestal::findOrfail($request->idprog);
              $progpres->pPCod=$request->codprog;
              $progpres->pPDesc=$request->descprog;
              $progpres->pPFecCrea=UtilController::fecha();
              $progpres->pPUsuReg=Auth::User()->id;
              $progpres->save();

            });

            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ProgramaPresupuestalController","edit");
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
        //AGREGADO 23-11-2020
        try {
            DB::transaction(function () use ($id) {
                $progpre = EPProgramaPresupuestal::findOrFail($id);
                ($progpre->pPEst === 1) ? $progpre->pPEst = 0 : $progpre->pPEst = 1;
                $progpre->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ProgramaPresupuestalController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }

    }
    public function getProgPres(){
        return Datatables::of(EPProgramaPresupuestal::join('users','pPUsuReg', '=', 'users.id')
        ->select(DB::raw("pPId,pPCod,pPDesc,DATE_FORMAT(pPFecCrea,'%d-%m-%Y') as pPFecCrea,users.name as uname,pPEst")))->make(true);
    }
    public function getProgPresEdit($id){
            Return EPProgramaPresupuestal::where('pPId','=',$id)->first();
        }
    public function ValidarProgramaPres($cod,$desc){
        //$tipo = EPTipo::where(['tdesc' => $tip])->select(DB::raw('count(tdesc) as cant'))->get();
        $ProgPres = EPProgramaPresupuestal::where(['pPCod' => $cod,'pPDesc'=>$desc])->select('pPId','pPCod','pPEst')->get();
        return response()->json(array('error' => 0, 'Prog' => $ProgPres));

    }
}
