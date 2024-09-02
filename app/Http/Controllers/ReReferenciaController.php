<?php

namespace App\Http\Controllers;

use App\ReDiagnostico;
use App\reReferencia;
use App\reRefPer;
use App\reUsuOfi;
use App\reOficinaEntidad;
use App\reUbicacion;
use App\reDocFile;
use App\reRevision;
use App\VConsumo;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use DateTime;

class ReReferenciaController extends Controller
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

    public function storeEstReferenc(Request $request)
    {
        try {
            $userId = auth()->user()->id; // or any string represents user identifier
            \Cart::session($userId)->add(array(
                'id' => $userId,
                'name' => 'referencia',
                'price' => 0,
                'quantity' => 1,
                'attributes' => array(
                    'ePid' => $request->ePid,
                    'pId' => $request->pId,
                    'idEess' => $request->idEess,
                    'idveh' => $request->idveh,
                    'rfecRef' => $request->rfecRef,
                    'motr' => $request->motr,
                    'nrofua' => $request->nrofua,
                    'per' => $request->per,
                    'idessor' => $request->idessor
                )
            ));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "storeEstReferenc");
            return response()->json(array('error' => $e->getMessage()));
        }
    }


    public function clearEstReferenc()
    {
        try {
            \Cart::session(auth()->user()->id)->clear();
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "storeEstReferenc");
            return response()->json(array('error' => $e->getMessage()));
        }
    }


    public function getEstReferenc()
    {
        try {

            return \Cart::session(Auth::user()->id)->get(Auth::user()->id);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "storeEstReferenc");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    /*public function store(Request $request)
    {
        try {

            $per = json_decode($request->per, true);
            DB::transaction(function () use ($request, $per) {
                date_default_timezone_set('America/Lima');
                $usu = new  reUsuOfi();
                $ref = new reReferencia();
                $ref->ePId = $request->ePid;
                $ref->afi_DNI = $request->pId;
                if ($request->idessor === '0') {
                    $ess = $usu->getTrabEss(Auth::user()->id);
                    $ref->idEssRef = $ess->idEess;
                } else
                    $ref->idEssRef = $request->idessor;
                $ref->cId = $request->cId;
                $ref->idEess = $request->idEess;
                if ($request->idveh !== '0') {
                    $ref->vId = $request->idveh;
                }
                $expire_timef = substr($request->fecref, 0, strpos($request->fecref, '('));
                $ref->rFecRef = date('Y-m-d H:i:s', strtotime($expire_timef));
                $expire_timer = substr($request->fecret, 0, strpos($request->fecret, '('));
                $ref->rFecRetor = date('Y-m-d H:i:s', strtotime($expire_timer));
                $ref->rMotRef = json_decode($request->motr);
                $ref->rNroFua = $request->nrofua;
                $ref->rUsuReg = Auth::user()->id;
                $ref->rFecCrea = UtilController::fecha();
                $ref->save();
                for ($i = 0; $i < count($per); $i++) {
                    $rrp = new reRefPer();
                    $rrp->pId = $per[$i][0];
                    $rrp->RId = $ref->rId;
                    $rrp->rPUsuReg = Auth::user()->id;
                    $rrp->rPFecCrea = UtilController::fecha();
                    $rrp->save();
                }
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
*/
    public function store(Request $request)
    {
        try {

            $per = json_decode($request->per, true);
            $cie = json_decode($request->cie, true);
            DB::transaction(function () use ($request, $per, $cie) {
                date_default_timezone_set('America/Lima');
                $usu = new  reUsuOfi();
                $ref = new reReferencia();
                $ref->ePId = $request->ePid;
                $ref->afi_DNI = $request->pId;
                if ($request->idessor === '0') {
                    $ess = $usu->getTrabEss(Auth::user()->id);
                    $ref->idEssRef = $ess->idEess;
                } else
                    $ref->idEssRef = $request->idessor;
                // $ref->cId = $request->cId;
                $ref->idEess = $request->idEess;
                if ($request->idveh !== '0') {
                    $ref->vId = $request->idveh;
                }
                $expire_timef = substr($request->fecref, 0, strpos($request->fecref, '('));
                $ref->rFecRef = date('Y-m-d H:i:s', strtotime($expire_timef));
                $expire_timer = substr($request->fecret, 0, strpos($request->fecret, '('));
                $ref->rFecRetor = date('Y-m-d H:i:s', strtotime($expire_timer));
                $ref->rMotRef = json_decode($request->motr);
                $ref->rNroFua = $request->nrofua;
                $ref->idPerRef = $request->idperref;
                $ref->idPerRec = $request->idperrec;
                $ref->rUsuReg = Auth::user()->id;
                $ref->rEstRec = 1;
                $ref->rFecCrea = UtilController::fecha();
                $ref->save();
                $idr = $ref->rId;
                for ($i = 0; $i < count($cie); $i++) {
                    $diag = new ReDiagnostico();
                    $diag->cId = $cie[$i][0];
                    $diag->rId = $idr;
                    $diag->dNUsuReg = Auth::user()->id;
                    $diag->save();
                }
                for ($i = 0; $i < count($per); $i++) {
                    $rrp = new reRefPer();
                    $rrp->pId = $per[$i][0];
                    $rrp->RId = $ref->rId;
                    $rrp->rPUsuReg = Auth::user()->id;
                    $rrp->rPFecCrea = UtilController::fecha();
                    $rrp->save();
                }
                $percont = new RePersonalController();
                $percont->storePersonalRecib($request->idveh, $idr);
                $this->updateFecRet($idr);
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }


    public function getReferenciasEstablecimiento()
    {

        try {
            $ref = new reReferencia();
            return Datatables::of($ref->referenciasESS(Auth::user()->id))->make(true);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "getReferenciasEstablecimiento");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function referenciasEntidad()
    {
        try {
            $ref = new reReferencia();
            return Datatables::of($ref->referenciasRed(Auth::user()->id))->make(true);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "getReferenciasEstablecimiento");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function referenciasUdr()
    {
        try {
            $ref = new reReferencia();
            return Datatables::of($ref->referenciasUdr(Auth::user()->id))->make(true);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "getReferenciasEstablecimiento");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function referenciasEjecutora()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param \App\reReferencia $reReferencia
     * @return \Illuminate\Http\Response
     */
    public function show(reReferencia $reReferencia)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\reReferencia $reReferencia
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try {

            DB::transaction(function () use ($request) {
                // dd();
                //$usu = new  reUsuOfi();
                // $ess = $usu->getTrabEss(Auth::user()->id);
              //  dd($request);
                $ref = reReferencia::findOrfail($request->idref);
                $ref->ePId = $request->estpr;
                $ref->afi_DNI = $request->dniedit;
                $ref->idEssRef = $request->estabedorid;
                $ref->idEess = $request->idessrr;
                if ($request->idveh !== '0') {
                    $ref->vId = $request->idveh;
                } else {
                    $ref->vId = null;
                }
                $ref->rMotRef = json_decode($request->motr);
                $ref->rNroFua = $request->nrofua;
                $ref->idPerRec = $request->idperdereced;
                $ref->idPerRef = $request->idperderefed;
               // echo  $request->fecreted;
               // $expire_timer = substr($request->fecreted, 0, strpos($request->fecreted, '('));
               // echo  $expire_timer;
               // $ref->rFecRetor = date('Y-m-d H:i:s', strtotime($expire_timer));
               // $expire_timer = substr($request->fecrefred, 0, strpos($request->fecrefred, '('));
               // echo  $expire_timer;
                //$ref->rFecRef = date('Y-m-d H:i:s', strtotime($expire_timer));;
                $ref->rUsuMod = Auth::user()->id;
                $ref->rFecmod = UtilController::fecha();
                $ref->save();
            });
            //return response()->json(array('error' => 0));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "edit");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\reReferencia $reReferencia
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reReferencia $reReferencia)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\reReferencia $reReferencia
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $ref = reReferencia::findOrFail($id);
                ($ref->rEst === 1) ? $ref->rEst = 0 : $ref->rEst = 1;
                $ref->rUsuMod = Auth::user()->id;
                $ref->rFecmod = UtilController::fecha();
                $ref->save();
                $per_ref = reReferencia::detallerefpers($id);
                for ($i = 0; $i < count($per_ref); $i++) {
                    $peref = reRefPer::findOrFail($per_ref[$i]->rPId);
                    ($peref->rPEst === 1) ? $peref->rPEst = 0 : $peref->rPEst = 1;
                    $peref->save();
                }
            });

            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function getDetRef($idref)
    {

        try {
            $ref = new reReferencia();
            return $ref->detalleref($idref);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "getDetRef");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function getDetPerRef($idref)
    {

        try {
            $ref = new reReferencia();
            $perref = $ref->detallerefpers($idref);
            $perref1 = Datatables::of($ref->detallerefpers($idref))->make(true);
            return response()->json(array('error' => 0, 'pref' => $perref, 'pref1' => $perref1));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "getDetPerRef");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function recibirDoc($idRef)
    {
        try {
            DB::transaction(function () use ($idRef) {
                // Recibir documentos
                $usuof = reUsuOfi::where('id', '=', Auth::user()->id)->first();
                $oe = reOficinaEntidad::where('oEId', '=', $usuof->oEId)->first();
                reUbicacion::where('rId', '=', $idRef)->update(['uEst' => 2]);
                $ubi = new reUbicacion();
                $ubi->oEId = $oe->oEId;
                $ubi->rId = $idRef;
                $ubi->fRevEst = 0;
                $ubi->fFecRecep = UtilController::fecha();
                $ubi->uUsuReg = Auth::user()->id;
                $ubi->save();
                $file = reDocFile::where('rId', '=', $idRef)->get();
                foreach ($file as $fil) {
                    $rev = new reRevision();
                    $rev->dFId = $fil->dFId;
                    $rev->uId = $ubi->uId;
                    $rev->rEstRev = 0;
                    $rev->rUsuReg = Auth::user()->id;
                    $rev->save();
                }
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "recibirDoc");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function pdfViatico($idConsumo)
    {
        try {
            $totales = [];
            $lug = [];
            (object)$lug[0]['l'] = 0;
            $idv = 0;
            $i = 0;
            $mes = null;
            $consumo = new reReferencia();
            $dias = $consumo->getDias($idConsumo);
            $result2 = $consumo->pdfViaticoII($idConsumo);
            $result3 = $consumo->pdfViaticoII1($idConsumo, $dias->dias);
            $result4 = $consumo->pdfViaticoII2($idConsumo, $dias->dias);
            foreach ($result2 as $r) {
                $totcomp = 0;
                $totdecla = 0;
                $totfond = 0;
                $totalv = 0;
                foreach ($result4 as $r2) {
                    if ($r->vId === $r2->vId) {
                        $idv = $r2->vId;
                        $totcomp += $r2->compro;
                        $totdecla += $r2->decla;
                        $totfond += $r2->subfond;
                        $totalv += $r2->total;
                    }
                }
                (object)$totales[$i]['idv'] = $idv;
                (object)$totales[$i]['tcomp'] = $totcomp;
                (object)$totales[$i]['tdecla'] = $totdecla;
                (object)$totales[$i]['tfondc'] = $totfond;
                (object)$totales[$i]['totalv'] = $totalv;
                $i++;
            }
            foreach ($result2 as $r) {
                $mes = $r->mes;
            }
            $uc = new UtilController();
            $consumo = new reReferencia();
            $result = $consumo->pdfViatico($idConsumo);
            $result1 = $consumo->pdfViatico1($idConsumo);
            $l = 0;
            $uc = new UtilController();
            $pdf = PDF::loadView('intranet.rendicion.pdf.formatoIII',
                array('result' => $result, 'result1' => $result1, 'result2' => $result2, 'result3' => $result3, 'result4' => $result4,
                    'totales' => $totales, 'lug' => $lug, 'mes' => $uc->convertirMesNumLet($mes)));
            //nombre pdf descarga
            return $pdf->download('Formatos_Viaticos.pdf');
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "pdfViatico");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function pdfFormatoIII($idr)
    {
        try {
            $lug = [];
            (object)$lug[0]['l'] = 1;
            $consumo = new reReferencia();
            $result = $consumo->pdfFormtIII($idr);
            $result1 = $consumo->pdfFormtIII1($idr);
            $pdf = PDF::loadView('intranet.rendicion.pdf.formatoIII',
                array('result' => $result, 'result1' => $result1, 'lug' => $lug));
            //nombre pdf descarga
            return $pdf->download('Formato_III.pdf');


        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "pdfFormatoIII");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function pdfFormatoII($idr)
    {
        try {
            $totales = [];
            $idv = 0;
            $i = 0;
            $mes = null;
            $consumo = new reReferencia();
            $dias = $consumo->getDiasRef($idr);
            $result = $consumo->pdfFormtII($idr);
            $result1 = $consumo->pdfFormtII1($idr, $dias->dias);
            $result2 = $consumo->pdfFormtII2($idr, $dias->dias);
            foreach ($result as $r) {
                $totcomp = 0;
                $totdecla = 0;
                $totfond = 0;
                $totalv = 0;
                foreach ($result2 as $r2) {
                    if ($r->vId === $r2->vId) {
                        $idv = $r2->vId;
                        $totcomp += $r2->compro;
                        $totdecla += $r2->decla;
                        $totfond += $r2->subfond;
                        $totalv += $r2->total;
                    }
                }
                (object)$totales[$i]['idv'] = $idv;
                (object)$totales[$i]['tcomp'] = $totcomp;
                (object)$totales[$i]['tdecla'] = $totdecla;
                (object)$totales[$i]['tfondc'] = $totfond;
                (object)$totales[$i]['totalv'] = $totalv;
                $i++;
            }
            foreach ($result as $r) {
                $mes = $r->mes;
            }
            $uc = new UtilController();
            //return view('intranet.rendicion.pdf.formatoII',array('result' => $result,'result1' => $result1,'mes'=>$uc->convertirMesNumLet($mes)));
            $pdf = PDF::loadView('intranet.rendicion.pdf.formatoII',
                array('result' => $result, 'result1' => $result1, 'result2' => $result2, 'totales' => $totales, 'mes' => $uc->convertirMesNumLet($mes)));
            //nombre pdf descarga
            return $pdf->download('Formato_II.pdf');
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "pdfFormatoII");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function pdfFormatoOfic($idr)
    {
        try {
            $cantgal = null;
            $mes = null;
            $refer = new reReferencia();
            $result = $refer->pdfOficio($idr);
            $result1 = $refer->pdfOficio1($idr);
            $result2 = $refer->pdfCie10($idr);
            //dd($result);
            foreach ($result as $r) {
                $mes = $r->mes;
            }
            $uc = new UtilController();
            $pdf = PDF::loadView('intranet.rendicion.pdf.formatoOficio',
                array('result' => $result, 'result1' => $result1, 'result2' => $result2, 'mes' => $uc->convertirMesNumLet($mes)));
            //nombre pdf descarga
            return $pdf->download('Formato_Oficio.pdf');
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "pdfFormatoOfic");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function pdfFormatoI($idr)
    {
        try {
            $totales = [];
            $mes = null;
            $i = 0;
            $refer = new reReferencia();
            $dias = $refer->getDiasRef($idr);
            $result = $refer->pdfFormtI($idr);
            $result1 = $refer->pdfFormtI1($idr, $dias->dias);
            foreach ($result as $r) {
                $totv = 0;
                $totp = 0;
                foreach ($result1 as $r2) {
                    if ($r->vId === $r2->idv) {
                        if ($r2->idtg === 1) {
                            $idv = $r2->idv;
                            $idtg = 1;
                            $totv += $r2->decla;
                        } else {
                            $idv = $r2->idv;
                            $idtg = 2;
                            $totp += $r2->decla;
                        }
                    }
                }
                (object)$totales[$i]['idv'] = $idv;
                (object)$totales[$i]['idtg'] = $idtg;
                (object)$totales[$i]['totv'] = $totv;
                (object)$totales[$i]['totp'] = $totp;
                $i++;
            }
            foreach ($result as $r) {
                $mes = $r->mes;
            }
            $uc = new UtilController();
            $pdf = PDF::loadView('intranet.rendicion.pdf.formatoI',
                array('result' => $result, 'result1' => $result1, 'totales' => $totales,'dias'=>$dias->dias, 'mes' => $uc->convertirMesNumLet($mes)));
            //nombre pdf descarga
            return $pdf->download('Formato_I.pdf');
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "pdfFormatoI");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function updateFecRet($rid)
    {
        try {
            DB::transaction(function () use ($rid) {
                /*  $ref = reReferencia::findOrFail($request->id);
                  $ref->rFecRetor = date('Y-m-d', strtotime($request->fec));
                  $ref->save();*/
                $df = ReDocFile::where('rId', '=', $rid)->get();
                foreach ($df as $d) {
                    if (in_array($d->dId, [1, 7, 8, 16, 17, 15, 19])) {
                        $rev = ReReVision::where('dFId', '=', $d->dFId)->get();
                        foreach ($rev as $re) {
                            $re->rEstRev = 1;
                            $re->rEstFecRev = UtilController::fecha();
                            $re->save();
                        }
                    }
                }
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function pdfFormatoInforme($idr)
    {
        try {
            $mes = null;
            $refer = new reReferencia();
            $result = $refer->pdfInforme($idr);
            $result1 = $refer->pdfOficio1($idr);
            $result2 = $refer->pdfCie10($idr);
            foreach ($result as $r) {
                $mes = $r->mes;
            }
            $uc = new UtilController();
            $pdf = PDF::loadView('intranet.rendicion.pdf.formatoInforme',
                array('result' => $result, 'result1' => $result1, 'result2' => $result2, 'mes' => $uc->convertirMesNumLet($mes)));
            //nombre pdf descarga
            return $pdf->download('Formato_Informe.pdf');
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "pdfFormatoInforme");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function pdfFormatoReembolso($idref)
    {
        try {
            $fua = 0;
            $nrofua = '';
            $refer = new reReferencia();
            $result = $refer->pdfFormReembols($idref);
            $result1 = $refer->pdfCie10($idref);
            foreach ($result as $r) {
                $fua = $r->rNroFua;
            }
            $nrofua = substr($fua, 0, 3) . '-' . substr($fua, 3, 2) . '-' . substr($fua, 5, 7);
            $uc = new UtilController();
            $pdf = PDF::loadView('intranet.rendicion.pdf.formatoReembolso',
                array('result' => $result, 'result1' => $result1, 'nrofua' => $nrofua));
            //nombre pdf descarga
            return $pdf->download('formato_AnexoI_.pdf');
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReReferenciaController", "pdfFormatoReembolso");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

}
