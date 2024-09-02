<?php

namespace App\Http\Controllers;

use App\EPCentroCosto;
use App\EPEspecificaGasto;
use App\EPFinalidad;
use App\EPMetaEpecificaGasto;
use App\EPModificacionPrespuestal;
use App\EPNotaModificatoria;
use App\EPPedido;
use App\EPPresupuesto;
use App\EPTipo;
use App\EPTransferencia;
use App\Usuario;
use http\Client\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use mysql_xdevapi\TableUpdate;
use Yajra\Datatables\Datatables;

class EjecucionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function obtenerTipo()
    {
        //return EPTipo::all();
        return EPTipo::where("tEst", "=", "1")->get();
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

    public function obtenerPedidosTrCodp($idesp, $idtr, $est)
    {
        return Datatables::of(EPPedido::obtenerPedidosTrCodp($idesp, $idtr, $est))->make(true);

    }

    public function obtenerEditarPedido($idped)
    {
        try {
            $pedido = EPPedido::findOrFail($idped);
            $meg = EPMetaEpecificaGasto::findOrFail($pedido->mEGId);
            $presupuesto = EPPresupuesto::where('mEGId', $meg->mEGId)->first();
            $espga = EPMetaEpecificaGasto::findOrFail($presupuesto->mEGId);
            $centCos = EPCentroCosto::centroCosto( $idped);
            return response()->json(array('error' => 0, 'pedido' => $pedido, 'presup' => $presupuesto, 'espga' => $espga, 'cencos' => $centCos));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "EjecucionController", "obtenerEditarPedido");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function obtenerPresupuesto()
    {
        return Datatables::of(EPPresupuesto::obtenerPresupuestoMetaEg())->make(true);
    }

    public function obtenerReporteTransferencia()
    {
        return Datatables::of(EPPresupuesto::obtenerReporteTransferencia())->make(true);
    }

    public function reporteEjecucion()
    {
        return Datatables::of(EPPresupuesto::reporteEjeucion())->make(true);
    }

    public function getReporteCeplan()
    {
        return Datatables::of(EPPresupuesto::reporteCeplan())->make(true);
    }

    public function obtenerReporteFinalidad()
    {
        return Datatables::of(EPPresupuesto::obtenerReporteFinalidad())->make(true);
    }

    public function reporteEjeEspecifica()
    {
        return Datatables::of(EPPresupuesto::reporteEjeEspecifica())->make(true);

    }

    public function obtenerReportePrograma()
    {
        return Datatables::of(EPPresupuesto::obtenerReportePrograma())->make(true);
    }

    public function obtenerReporteProgramaTransferencia()
    {
        return Datatables::of(EPPresupuesto::obtenerReporteProgramaTransferencia())->make(true);
    }

    public function obtenerReporteTrama()
    {
        return Datatables::of(EPPresupuesto::ObtenerReporteTrama())->make(true);
    }
    public function obtenerReportePedido()
    {
        return Datatables::of(EPPresupuesto::ObtenerReportePedido())->make(true);
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
            $lispedi = json_decode($request->lisped, true);
            $agrup=EPPedido::all()->count();
            DB::transaction(function () use ($request,$lispedi,$agrup) {
                if($request->cond==1){
                    for ($i = 0; $i < count($lispedi); $i++) {
                        $ejecucion = new EPPedido();
                        $ejecucion->tId = $request->tip;
                        $ejecucion->mEGId = $lispedi[$i][2];
                        $ejecucion->peCodPed = $lispedi[$i][0];
                        $ejecucion->trId = $request->codtrans;
                        $ejecucion->cCId = $lispedi[$i][1];
                        $ejecucion->peEstPed = $request->estado;
                        $ejecucion->peDesc = json_decode($request->sus);
                        $ejecucion->peMonto = $lispedi[$i][3];
                        $ejecucion->peAgrupador = $agrup+1;
                        $ejecucion->peFecPre = date('Y-m-d', strtotime($request->fecpre));
                        $ejecucion->peFecCrea = UtilController::fecha();
                        $ejecucion->peUsuReg = Auth::user()->id;
                        $ejecucion->peEst = 1;
                        $ejecucion->save();
                    }
                }else{
                    for ($i = 0; $i < count($request->mont); $i++) {
                        $ejecucion = new EPPedido();
                        $ejecucion->tId = $request->tip;
                        $ejecucion->mEGId = $request->npre[$i];
                        $ejecucion->peCodPed = $request->nropedido;
                        $ejecucion->trId = $request->codtrans;
                        $ejecucion->cCId = $request->idcenc;
                        $ejecucion->peEstPed = $request->estado;
                        $ejecucion->peDesc = json_decode($request->sus);
                        $ejecucion->peMonto = $request->mont[$i];
                        $ejecucion->peFecPre = date('Y-m-d', strtotime($request->fecpre));
                        $ejecucion->peFecCrea = UtilController::fecha();
                        $ejecucion->peUsuReg = Auth::user()->id;
                        $ejecucion->peEst = 1;
                        $ejecucion->save();
                    }
                }
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "EjecucionController", "store");
            return response()->json(array('error' => $e->getMessage()));
        }


    }

    public function getPedidoDetalle($id)
    {
        try {
            return response()->json(array('error' => 0, 'ped' => EPPedido::getPedidoDetalle($id)));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "EjecucionController", "getPedidoDetalle");
            return response()->json(array('error' => $e->getMessage()));
        }
    }


    public function obtenerPedidos()
    {
        try {
            return Datatables::of(EPPedido::obtenerPedidos())->make(true);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "EjecucionController", "obtenerPedidos");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function cambiarEstadoPedido($idpedido, $estado)
    {
        try {
            DB::transaction(function () use ($idpedido, $estado) {
                $pedido = EPPedido::findOrFail($idpedido);
                $pedido->peEstPed = $estado;
                $pedido->peUsuReg = Auth::user()->id;
                $pedido->peEst = 1;
                $pedido->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "EjecucionController", "cambiarEstadoPedido");
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
                $ejecucion = EPPedido::findOrFail($request->idpedidoedit);
                $ejecucion->tId = $request->tip;
                $ejecucion->mEGId = $request->espgas;
                $ejecucion->peCodPed = $request->nropedido;
                $ejecucion->trId = $request->codtrans;
                $ejecucion->peEstPed = $request->estado;
                $ejecucion->peDesc = json_decode($request->sus);
                $ejecucion->peMonto = $request->mont;
                $ejecucion->cCId = $request->idcenc;
                $ejecucion->peFecPre = date('Y-m-d', strtotime($request->fecpre));
                $ejecucion->peFecCrea = UtilController::fecha();
                $ejecucion->peUsuReg = Auth::user()->id;
                $ejecucion->peEst = 1;
                $ejecucion->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "EjecucionController", "edit");
            return response()->json(array('error' => $e->getMessage()));
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
        //
    }

    public function validarPedido($nropedido, $tip)
    {

        $pedido = EPPedido::where(['peCodPed' => $nropedido, 'tId' => $tip])->select(DB::raw('count(peCodPed) as cant'))->get();
        return response()->json(array('error' => 0, 'ped' => $pedido));

    }

    public function obtenerFinalidad(Request $request)
    {
        $term = $request->input('term');
        return EPFinalidad::obtenerFinalidadTermino($term);
    }

    public function obtenerFinalidadDesc(Request $request)
    {
        list($cod) = explode(".", $request->desc);
        $rest = substr($cod, -7);
        return EPFinalidad::obtenerFinalidadDesc($rest);
    }

    public function obtenerTransferenciasModifica2($id)
    {
        return EPPresupuesto::obtenerTransferenciasModifica2($id);

    }

    public function getTransferenciaId($id)
    {
        return EPTransferencia::findOrFail($id);
    }

    public function obtenerSaldo($idtr, $ideg)
    {

        try {
            //$query = EPPresupuesto::where('pId', $pId)->first();
            $saldo = EPPresupuesto::obtenerSaldo($ideg, $idtr);
            return response()->json(array('error' => 0, 'saldo' => $saldo));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "EjecucionController", "obtenerSaldo");
            return response()->json(array('error' => $e->getMessage()));
        }

    }

    /* public function obtenerSaldo($pId)
     {

         try {
             $query = EPPresupuesto::where('pId', $pId)->first();
             $saldo = EPPresupuesto::obtenerSaldo($query->mEGId, $query->trId);
           //  return response()->json(array('error' => 0, 'saldo' => $saldo));
         } catch (\Exception $e) {
             SErrorController::saveerror($e->getMessage(), "EjecucionController", "obtenerSaldo");
             return response()->json(array('error' => $e->getMessage()));
         }

     }*/

    public function eliminarPedido($pId)
    {
        try {
            DB::transaction(function () use ($pId) {
                $pedido = EPPedido::findOrFail($pId);
                ($pedido->peEst === 1) ? $pedido->peEst = 0 : $pedido->peEst = 1;
                $pedido->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "EjecucionController", "eliminarPedido");
            return response()->json(array('error' => $e->getMessage()));
        }

    }

    public function obtenerIncorporacionEdit($id)
    {
        try {

            $presupuesto = EPPresupuesto::findOrFail($id);
            $meta = EPMetaEpecificaGasto::findOrFail($presupuesto->mEGId);
            return response()->json(array('error' => 0, 'pres' => $presupuesto, 'met' => $meta));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "EjecucionController", "obtenerIncorporacionEdit");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public static function obtenerModificacionEdit($id)
    {
        return DB::table('e_p_nota_modificatoria as m')
            ->select('m.nId', 'm.idEjecutora', 'p.mPId', 'pr.pId', 'meg.mId', 'm.nDoc', 'meg.mEGId', 'm.nSustento', 'tra.trId', 'm.nFecNotaSoli', 'tra.trNumRj', 'm.nNro', 'm.nTipModifica', 'me.mCod', DB::raw('concat(eg.eGCod ," ", eg.eGDesc) as egdesc'), 'pr.pMonto', 'e.descripcionEjecutora', 'pr.pEst')
            ->join('e_p_modificacion_prespuestal as p', 'p.nId', '=', 'm.nId')
            ->join('e_p_presupuesto as pr', 'pr.mPId', '=', 'p.mPId')
            ->join('e_p_transferencia as tra', 'tra.trId', '=', 'pr.trId')
            ->join('e_p_meta_epecifica_gasto as meg', 'pr.mEGId', '=', 'meg.mEGId')
            ->join('e_p_especifica_gasto as eg', 'eg.eGId', '=', 'meg.eGId')
            ->join('e_p_meta as me', 'meg.mId', '=', 'me.mId')
            ->leftjoin('ejecutora as e', 'e.idEjecutora', '=', 'm.idEjecutora')
            ->where('m.nId', '=', $id)
            ->orderby('m.nFecCrea', 'desc')->get();

    }
}
