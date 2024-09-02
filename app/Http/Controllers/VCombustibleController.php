<?php

namespace App\Http\Controllers;

use App\VCombustible;
use App\VConsumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;

class VCombustibleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return Datatables(VCombustible::getCombustibles())->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VCombustibleController","index");
            return response(array('error'=>$e->getMessage()));
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
                $combus=New VCombustible();

                $combus->cOTId=$request->idcot;
                $combus->mEGId=$request->idmeg;
                $combus->cStock=$request->stock;
                $combus->cMUsuReg = Auth::user()->id;
                $combus->cMFecCrea = UtilController::fecha();
                $combus->save();

            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"VCombustibleController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VCombustible  $vCombustible
     * @return \Illuminate\Http\Response
     */
    public function show(VCombustible $vCombustible)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VCombustible  $vCombustible
     * @return \Illuminate\Http\Response
     */
    public function edit($idc)
    {
        try {
            $comb = VCombustible::getCombusEdit($idc);
            return response()->json(array('error' => 0, 'comb' =>  $comb));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VCombustibleController", "edit");
            return response(array('error' => $e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VCombustible  $vCombustible
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            DB::transaction(function () use ($request) {
                $combus=VCombustible::findOrfail($request->idcomb);

                $combus->cOTId=$request->idcot;
                $combus->mEGId=$request->idmeg;
                $combus->cStock=$request->stock;
                $combus->cMUsuReg = Auth::user()->id;
                $combus->cMFecCrea = UtilController::fecha();
                $combus->save();

            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"VCombustibleController","update");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VCombustible  $vCombustible
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function () use ($id) {
                $combus=VCombustible::findOrfail($id);

                ($combus->cMEst === 1) ? $combus->cMEst = 0 : $combus->cMEst = 1;
                $combus->cMFecCrea = UtilController::fecha();
                $combus->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"VCombustibleController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getMetasEGComb()
    {
        try {
            $megcom = VCombustible::getMetaEGComb();
            return response()->json(array('error' => 0, 'megc' =>  $megcom));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VCombustibleController", "getMetasEGComb");
            return response(array('error' => $e->getMessage()));
        }
    }
    public function getValesOC($idcb)
    {
        try{
            //dd(VConsumo::getValesOC($idcb));
            return Datatables(VConsumo::getValesOC($idcb))->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VCombustibleController","getValesOC");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
