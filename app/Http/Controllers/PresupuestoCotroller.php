<?php

namespace App\Http\Controllers;

use App\EPPresupuesto;
use App\EPTecPresupuestal;
use App\reReferencia;
use App\reRefPer;
use App\reUsuOfi;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class PresupuestoCotroller extends Controller
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $per = json_decode($request->per, true);
            DB::transaction(function () use ($request, $per) {
                for ($i = 0; $i < count($per); $i++) {
                    $pres = new EPPresupuesto();
                    $pres->mEGId = $per[$i][0];
                    $pres->trId = $request->nrrj;
                    $pres->pMonto = $per[$i][3];
                    $pres->pFecCrea = UtilController::fecha();
                    $pres->pUsuReg = Auth::user()->id;
                    $pres->pEst = 1;
                    $pres->save();
                }
            });
            return response()->json(array('error' => 0));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "PresupuestoCotroller", "store");
            return response()->json(array('error' => $e->getMessage()));
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
        try {
            DB::transaction(function () use ($request) {
                $pres = EPPresupuesto::findOrFail($request->idinc);
                $pres->mEGId = $request->esga;
                $pres->trId = $request->nrrj;
                $pres->pMonto = $request->monme;
                $pres->pFecCrea = UtilController::fecha();
                $pres->pUsuReg = Auth::user()->id;
                $pres->pEst = 1;
                $pres->save();
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
        try {
            DB::transaction(function () use ($id) {
                $pres = EPPresupuesto::findOrFail($id);
                ($pres->pEst === 1) ? $pres->pEst = 0 : $pres->pEst = 1;
                $pres->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }


    public function getTecho(Request $request)
    {
        return EPPresupuesto::getTecho($request->trid, $request->ppi);
    }
    public function getTechoPres($idtr)
    {
        return Datatables::of(EPPresupuesto::getTechoPres($idtr))->make(true);
        //return Datatables::of( EPTecPresupuestal::gettecpres($idtr))->make(true);
    }

}
