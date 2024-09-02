<?php

namespace App\Http\Controllers;

use App\EPModificacionPrespuestal;
use App\EPNotaModificatoria;
use App\EPPresupuesto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ModificacionPresupuestalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function obtenerNotaModificatoria()
    {
        return EPNotaModificatoria::all();
    }

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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $npr = New EPNotaModificatoria();
                if ($request->ejec !== '0')
                    $npr->idEjecutora = $request->ejec;
                else
                    $npr->idEjecutora = null;
                $npr->nNro = $request->nnota;
                $npr->nFecNotaSoli = date('Y-m-d', strtotime($request->fecpre));
                $npr->nSustento = json_decode($request->sustn);
                $npr->nDoc = $request->ndoc;
                $npr->nTipModifica = $request->tipmod;
                $npr->nFecCrea = UtilController::fecha();
                $npr->nUsuReg = Auth::user()->id;
                $npr->save();
                $nId= $npr->nId;

                for ($i = 0; $i < count($request->idme); $i++) {
                    $mp = new EPModificacionPrespuestal();
                    $mp->mTipMod = $request->tipo[$i];
                    $mp->mPFecCrea = UtilController::fecha();
                    $mp->mPUsuReg = Auth::user()->id;;
                    $mp->nId = $nId;
                    $mp->save();
                    $mPId = $mp->mPId;
                   $pres = new EPPresupuesto();
                    $pres->mEGId = $request->idme[$i];
                    $pres->mPId = $mPId;
                    $pres->trId = $request->idtrans;
                    if ($request->tipo[$i] === '0')
                        $pres->pMonto = -1*($request->monto[$i]);
                    else
                        $pres->pMonto = $request->monto[$i];
                    $pres->pSusten = $request->sustn;
                    $pres->pFecCrea = UtilController::fecha();
                    $pres->pUsuReg = Auth::user()->id;
                    $pres->save();
                }

            });
            return response()->json(array('error' => 0));

        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        //$tip=0;
        try {
            DB::transaction(function () use ($request) {
                //$tip=0;
                $npr =  EPNotaModificatoria::findOrFail($request->idnota);
                /*if ($request->ejec !=='0'){
                    $tip=0;
                    $npr->idEjecutora = $request->ejec;
                } else{
                    $tip=1;
                    $npr->idEjecutora = null;
                }*/
                $npr->idEjecutora = $request->ejec;
                $npr->nNro = $request->nnota;
                $npr->nFecNotaSoli = date('Y-m-d', strtotime($request->fecpre));
                $npr->nSustento = $request->sustn;
                $npr->nDoc = $request->ndoc;
                $npr->nTipModifica = $request->tipmod;
                $npr->nFecCrea = UtilController::fecha();
                $npr->nUsuReg = Auth::user()->id;
                $npr->save();
                //$nId= $npr->nId;

                for ($i = 0; $i < count($request->idme); $i++) {
                    if($request->nreg[$i]=='0'){
                        $mp =  EPModificacionPrespuestal::findOrFail($request->idmp[$i]);
                        $mp->mTipMod = $request->tipo[$i];
                        $mp->mPFecCrea = UtilController::fecha();
                        $mp->mPUsuReg = Auth::user()->id;
                        if($request->tip==0 && $request->tipo[$i]==1){
                            $mp->mPEst=0;
                        }
                        $mp->nId = $request->idnota;
                        $mp->save();

                        $pres =  EPPresupuesto::findOrFail($request->idp[$i]);
                        $pres->mEGId = $request->idme[$i];
                        $pres->mPId = $request->idmp[$i];
                        $pres->trId = $request->idtrans;
                        if ($request->tipo[$i] === '0')
                            $pres->pMonto = -1*($request->monto[$i]);
                        else
                            $pres->pMonto = $request->monto[$i];
                        $pres->pSusten = $request->sustn;
                        $pres->pFecCrea = UtilController::fecha();
                        $pres->pUsuReg = Auth::user()->id;
                        if($request->tip==0 && $request->tipo[$i]==1){
                            $pres->pEst=0;
                        }
                        $pres->save();
                    }else{
                        //Agregar Nueva Modificacion presupuestal
                        $mp = new EPModificacionPrespuestal();
                        $mp->mTipMod = $request->tipo[$i];
                        $mp->mPFecCrea = UtilController::fecha();
                        $mp->mPUsuReg = Auth::user()->id;;
                        $mp->nId = $request->idnota;
                        $mp->save();
                        $mPId = $mp->mPId;
                        //Agergar Nuevo presupuesto
                        $pres = new EPPresupuesto();
                        $pres->mEGId = $request->idme[$i];
                        $pres->mPId = $mPId;
                        $pres->trId = $request->idtrans;
                        if ($request->tipo[$i] === '0')
                            $pres->pMonto = -1*($request->monto[$i]);
                        else
                            $pres->pMonto = $request->monto[$i];
                        $pres->pSusten = $request->sustn;
                        $pres->pFecCrea = UtilController::fecha();
                        $pres->pUsuReg = Auth::user()->id;
                        $pres->save();
                    }

                }

            });
            return response()->json(array('error' => 0));

        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //AGREGADO 02-11-2020
        try {
            DB::transaction(function () use ($id) {
                $not = EPNotaModificatoria::findOrFail($id);
                ($not->nEst === 1) ? $not->nEst = 0 : $not->nEst = 1;
                $not->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerModificacion(){
        return Datatables::of(EPModificacionPrespuestal::obtenerModificacion())->make(true);
    }
    public function obtenerModificacionPre(){
        return Datatables::of(EPModificacionPrespuestal::obtenerModificacionPres())->make(true);
    }
    public function ValidarnNot($not){
        $nota = EPNotaModificatoria::where(['nNro' => $not])->select('nId','nNro','nEst')->get();
        return response()->json(array('error' => 0, 'not' => $nota));

    }
}
