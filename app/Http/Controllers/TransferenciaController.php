<?php

namespace App\Http\Controllers;

use App\EPConcepto;
use App\EPEspecificaGasto;
use App\EPfuenteFinanciamiento;
use App\EPMeta;
use App\EPTecPresupuestal;
use App\EPTransferencia;
use function Composer\Autoload\includeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class TransferenciaController extends Controller
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

    public function getConcepto()
    {
        return EPConcepto::where("cEstado","=","1")->get();
    }

    public function obtenerEspecificasMeta($idmeta)
    {
        return EPEspecificaGasto::obtenerEspecificasMeta($idmeta);
    }

    public function obtenerMetas()
    {
        return EPMeta::orderBy('mCod')->get();
    }
    public function getMetasTransf($idtr)
    {
        return EPMeta::getMetasTransf($idtr);
    }
    public function obtenerMetasTr($idtra)
    {
        return EPMeta::obtenerMetaidTrans($idtra);
    }

    public function obtenerFuenteFinaciamiento()
    {
        return EPfuenteFinanciamiento::where("fFEst","=","1")->get();
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function validarTransferencias(Request $request)
    {

        return EPTransferencia::where('trNumRj', $request->val)->select(DB::raw('count(trId) as cant'))->get();
    }

    public function obtenerTransferencias()
    {
        return EPTransferencia::where('trEst',1)->select('*')->get();
    }

    public function obtenerTransferenciasId($id)
    {
        return EPTransferencia::obtenerTransferenciaId($id);
    }

    public function obtenerTransferenciasReporte()
    {
        try {
            return Datatables::of(EPTransferencia::obtenerTransferenciasReporte())->make(true);
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function create()
    {
        return view('intranet.ejecucionpresupuestal.transferencia');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {


        DB::transaction(function () use ($request) {
            $arrc = json_decode($request->arrc);
            $arrpp = json_decode($request->arrpp);
            $arrm = json_decode($request->arrm);
            $transf = New EPTransferencia();
            $transf->fFId = $request->fufi;
            $transf->trNumRj = $request->numrj;
            $transf->trCodTrans = $request->codtra;
            $transf->trMonto = $request->monto;
            $transf->trFecCrea = UtilController::fecha();
            $transf->trUsuReg = Auth::user()->id;
            $transf->trEst = 1;
            $transf->save();
            for ($i = 0; $i < count($arrc); $i++) {
                $eptecpre = New EPTecPresupuestal();
                $eptecpre->pPId = $arrpp[$i];
                $eptecpre->trId = $transf->trId;
                $eptecpre->cId = $arrc[$i];
                $eptecpre->tpMonto = $arrm[$i];
                $eptecpre->tpUsuReg = Auth::user()->id;;
                $eptecpre->cEstado = 1;
                $eptecpre->save();
            }

        });
        return response()->json(array('error' => 0));

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            return EPTransferencia::where('trId', $id)->first();
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
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
                $transf = EPTransferencia::findOrFail($request->idtrans);
                $transf->fFId = $request->fufi;
                $transf->trNumRj = $request->numrj;
                $transf->trCodTrans = $request->codtra;
                $transf->trMonto = $request->monto;
                $transf->trFecCrea = UtilController::fecha();
                $transf->trUsuReg = Auth::user()->id;
                $transf->trEst = 1;
                $transf->save();
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
                $trans = EPTransferencia::findOrFail($id);
                ($trans->trEst === 1) ? $trans->trEst = 0 : $trans->trEst = 1;
                $trans->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function gettec($trid)
    {
        return Datatables::of(EPTecPresupuestal::tecpres($trid))->make(true);

    }

    public function gettecedit($trid)
    {
        return Datatables::of(EPTecPresupuestal::gettecedit($trid))->make(true);

    }

    public function tecedit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $tecp = EPTecPresupuestal::where(['pPId' => $request->pi, 'trId' => $request->tr, 'cId' => $request->ci,'tpMonto'=>$request->mo])->first();
                if (empty($tecp)) {
                    $eptecpre = New EPTecPresupuestal();
                    $eptecpre->pPId = $request->pi;
                    $eptecpre->trId = $request->tr;
                    $eptecpre->cId = $request->ci;
                    $eptecpre->tpMonto = $request->mo;
                    $eptecpre->tpUsuReg = Auth::user()->id;;
                    $eptecpre->cEstado = 1;
                    $eptecpre->save();
                } else {
                    $tecp->cEstado = 1;
                    $tecp->save();
                }
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }


    }

    public function deletetec(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $tecp = EPTecPresupuestal::findOrFail($request->id);
                $tecp->cEstado = 0;
                $tecp->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }


    }

}
