<?php

namespace App\Http\Controllers;

use App\reCie10;
use App\ViGasto;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\Facades\DataTables;

class ReCie10Controller extends Controller
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

    public function getDetCie10($idref)
    {

        try {
            $ref = new reCie10();
           $cie = $ref->idrCie10($idref);
            return response()->json(array('error' => 0, 'tab' => $cie));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReCie10Controller", "getDetCie10");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function getCie10(Request $request)
    {
        try {
            $term = $request->input('term');
            return reCie10::getCie10($term);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), 'ReCie10Controller', 'getCie10');
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::transaction(function () use ($request) {
                $cie=New reCie10();
                $cie->cCodigo=$request->codcie;
                $cie->cDescripcion=$request->desccie;
                $cie->cUsuReg = Auth::user()->id;
                $cie->cFecCrea = UtilController::fecha();
                $cie->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ReCie10Controller","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\reCie10 $reCie10
     * @return \Illuminate\Http\Response
     */
    public function show(reCie10 $reCie10)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\reCie10 $reCie10
     * @return \Illuminate\Http\Response
     */
    public function edit($idcie)
    {
        try{
            Return reCie10::where('cId','=',$idcie)->first();
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReCie10Controller","edit");
            return response(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\reCie10 $reCie10
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            DB::transaction(function () use ($request) {
                    $cie=   reCie10::findOrfail($request->idcie);
                    $cie->cCodigo=$request->codcie;
                    $cie->cDescripcion=$request->desccie;
                    $cie->cUsuReg = Auth::user()->id;
                    $cie->cFecCrea = UtilController::fecha();
                    $cie->save();

            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ReCie10Controller","update");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\reCie10 $reCie10
     * @return \Illuminate\Http\Response
     */
    public function destroy($idcie)
    {
        try{
            DB::transaction(function() use($idcie){
                $cie=reCie10::findOrfail($idcie);
                ($cie->cEst === 1) ? $cie->cEst = 0 : $cie->cEst = 1;
                $cie->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReCie10Controller","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getCies10()
    {
        try{
            return DataTables::of(reCie10::select('cId','cCodigo','cDescripcion','cEst',
            DB::raw("DATE_FORMAT(cFecCrea,'%d-%m-%Y') as cFecCrea"))->get())->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReCie10Controller","etCies10");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function validarCie($des)
    {
        try{
            $cie = reCie10::where(['cDescripcion' => $des])->select('cId','cCodigo','cDescripcion','cEst')->get();
            return response()->json(array('error' => 0, 'cie' => $cie));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReCie10Controller","validarCie");
            return response(array('error'=>$e->getMessage()));
        }

    }
}
