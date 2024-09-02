<?php

namespace App\Http\Controllers;

use App\EPPresupuesto;
use App\VCombustible;
use App\VConsumo;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class VConsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vi=1;
            return view('intranet.combustible.valeconsumo')->with(array('vi' => $vi));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VConsumoController", "index");
            return response(array('error' => $e->getMessage()));
        }
    }
    public function getConsumos()
    {
        try {
            return Datatables(VConsumo::getValConsumos())->make(true);
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VConsumoController", "index");
            return response(array('error' => $e->getMessage()));
        }
    }

    public function pdfVale($idConsumo)
    {
        try {
            $cantgal = null;
            $cantent = null;
            $cantdec = null;
            $mes = null;
            $consumo = new VConsumo();
            $result = $consumo->pdfConsumo($idConsumo);
            foreach ($result as $r) {
                $cantgal = $r->cCantGal;
                $pieces = explode(".", $cantgal);
                $cantent=$pieces[0];
                $cantdec=$pieces[1];
                $mes = $r->mes;
            }
            $uc = new UtilController();
            $pdf = PDF::loadView('intranet.combustible.pdf.vale_consumo',
                array('result' => $result, 'galent' => ucfirst($uc->convertirNumero($cantent)),'galdec' => ucfirst($uc->convertirNumero($cantdec)),'mes'=>$uc->convertirMesNumLet($mes)));
            //nombre pdf descarga
           return $pdf->download('consumo_fec_.pdf');
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VConsumoController", "pdfVale");
            return response()->json(array('error' => $e->getMessage()));
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

                $comsum = new VConsumo();
                $comsum->cMId = $request->idcombus;
                $comsum->vId = $request->idvehi;
                $comsum->pId = $request->idchof;
                $comsum->cDocAuto = $request->dauto;
                $comsum->cFecEnt = date('Y-m-d', strtotime($request->fecent));
                $comsum->cCantKil = $request->cntkm;
                $comsum->cCantGal = $request->cntgal;
                $comsum->cActiv = $request->activ;
                $comsum->cUsuReg = Auth::user()->id;
                $comsum->cFecCrea = UtilController::fecha();
                $comsum->save();
                $id = $comsum->cId;
                return response()->json(array('error' => 0,'id'=>$id));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VConsumoController", "store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\VConsumo $vConsumo
     * @return \Illuminate\Http\Response
     */
    public function show(VConsumo $vConsumo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\VConsumo $vConsumo
     * @return \Illuminate\Http\Response
     */
    public function edit(VConsumo $vConsumo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\VConsumo $vConsumo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {

            $comsum = VConsumo::findOrFail($request->idcons);
            $comsum->cMId = $request->idcombus;
            $comsum->vId = $request->idvehi;
            $comsum->pId = $request->idchof;
            $comsum->cDocAuto = $request->dauto;
            $comsum->cFecEnt = date('Y-m-d', strtotime($request->fecent));
            $comsum->cCantKil = $request->cntkm;
            $comsum->cCantGal = $request->cntgal;
            $comsum->cActiv = $request->activ;
            $comsum->cUsuReg = Auth::user()->id;
            $comsum->cFecCrea = UtilController::fecha();
            $comsum->save();
            $id = $comsum->cId;
            return response()->json(array('error' => 0,'id'=>$id));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VConsumoController", "update");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\VConsumo $vConsumo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $consum = VConsumo::findOrFail($id);
                ($consum->cEst === 1) ? $consum->cEst = 0 : $consum->cEst = 1;
                $consum->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VConsumoController", "destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function getMetaEGV($idocc)
    {
        try {
            $megval = VConsumo::getMetaEGVale($idocc);
            return response()->json(array('error' => 0, 'megval' => $megval));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VComsumoController", "getMetaEGV");
            return response(array('error' => $e->getMessage()));
        }
    }

    public function getSaldoComb($idc)
    {
        try {
            $sald = VCombustible::getSaldo($idc);
            return response()->json(array('error' => 0, 'saldoc' => $sald));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VComsumoController", "getSaldoComb");
            return response(array('error' => $e->getMessage()));
        }
    }
    public function getValConsEdit($idc)
    {
        try {
            $valcomb= VConsumo::getValConsumoEdit($idc);
            return response()->json(array('error' => 0, 'valcomb' => $valcomb));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VComsumoController", "getValConsEdit");
            return response(array('error' => $e->getMessage()));
        }
    }

    public function reportegeneralval()
    {
        return Datatables::of(VConsumo::reportegeneralval())->make(true);

    }
}
