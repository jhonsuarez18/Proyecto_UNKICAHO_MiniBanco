<?php

namespace App\Http\Controllers;

use App\ReDiagnostico;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ReDiagnosticoController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ReDiagnostico $reDiagnostico
     * @return \Illuminate\Http\Response
     */
    public function show(ReDiagnostico $reDiagnostico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ReDiagnostico $reDiagnostico
     * @return \Illuminate\Http\Response
     */
    public function edit(ReDiagnostico $reDiagnostico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ReDiagnostico $reDiagnostico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ReDiagnostico $reDiagnostico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ReDiagnostico $reDiagnostico
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            DB::transaction(function () use ($id) {
                $diag = ReDiagnostico::findOrFail($id);
                ($diag->dNEst === 1) ? $diag->dNEst = 0 : $diag->dNEst = 1;
                $diag->dNUsuMod = Auth::user()->id;
                $diag->dNFecMod = UtilController::fecha();
                $diag->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReDiagnosticoController", "destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function addeditcie10($idr, $idci)
    {
        try {
            DB::transaction(function () use ($idr, $idci) {
                $diag = ReDiagnostico::where(['cId' => $idci, 'rId' => $idr])->first();
                if ($diag)
                    $this->destroy($diag->dNId);
                else {
                    $diag = new ReDiagnostico();
                    $diag->cId = $idci;
                    $diag->rId = $idr;
                    $diag->dNUsuReg = Auth::user()->id;
                    $diag->save();
                }
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReDiagnosticoController", "addeditcie10");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
