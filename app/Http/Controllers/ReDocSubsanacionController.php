<?php

namespace App\Http\Controllers;

use App\Eess;
use App\MicroRed;
use App\reObservacion;
use App\reReferencia;
use App\reUbicacion;
use App\reDocSubsanacion;
use App\reRevision;
use App\reOficinaEntidad;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReDocSubsanacionController extends Controller
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

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), 'ReDocSubsanacionController', 'store');
            return response()->json(array('error' => $e->getMessage()));
        }

    }

    public function recibirDocumentoSubsanacionEess($idUbi)
    {
        try {
            $ubi = reUbicacion::findOrFail($idUbi);
            $ref = reReferencia::findOrFail($ubi->rId);
            $roe = reOficinaEntidad::where('idEess', '=', $ref->idEssRef)->first();
            $ubi->uEst = 2;
            $ubi->save();
            $ubi2 = new reUbicacion();
            $ubi2->rId = $ubi->rId;
            $ubi2->oEId = $roe->oEId;
            $ubi2->fRevEst = $ubi->fRevEst;
            $ubi2->fFecRevi = $ubi->fFecRevi;
            $ubi2->fFecRecep = UtilController::fecha();
            $ubi2->uUsuReg = Auth::user()->id;
            $ubi2->save();
            $rev = reRevision::where('uId', '=', $ubi->uId)->get();
            foreach ($rev as $rv) {
                $rev2 = new reRevision();
                $rev2->dFId = $rv->dFId;
                $rev2->uId = $ubi2->uId;
                $rev2->rEstFecRev = $rv->rEstFecRev;
                $rev2->rEstRev = $rv->rEstRev;
                $rev2->rUsuReg = $rv->rUsuReg;
                $rev2->save();
                if ($rv->rEstRev === 3) {
                    $obs1 = reObservacion::where('rId', '=', $rv->rId)->first();
                    $obs2 = new reObservacion();
                    $obs2->rId = $rev2->rId;
                    $obs2->oMotivo = $obs1->oMotivo;
                    $obs2->rUsuReg = $obs1->rUsuReg;
                    $obs2->save();
                }
            }
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), 'ReDocSubsanacionController', 'recibirDocumentoSubsanacion');
            return response()->json(array('error' => $e->getMessage()));
        }

    }

    public function subsanarObs($idrev)
    {
        try {

            $conobs = 0;
            $obs = reObservacion::where('rId', '=', $idrev)->first();
            $obs->rEst = 2;
            $obs->rUsuReg = Auth::user()->id;
            $obs->save();
            $rev = reRevision::where('rId', '=', $idrev)->first();
            $rev->rEstRev = 4;
            $rev->rUsuReg = Auth::user()->id;
            $rev->save();
            $revs = reRevision::where('uId', '=', $rev->uId)->get();
            foreach ($revs as $rv) {
                if ($rv->rEstRev === 3)
                    $conobs++;
            }
            if ($conobs <= 0) {
                $ubi = reUbicacion::findOrFail($rev->uId);
                $ubi->fRevEst = 3;
                $ubi->fFecRevi = UtilController::fecha();
                $ubi->save();
            }
            if ($conobs > 0) return response()->json(array('error' => 0));
            else return response()->json(array('error' => 1));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), 'ReDocSubsanacionController', 'recibirDocumentoSubsanacion');
            return response()->json(array('error' => $e->getMessage()));
        }

    }

    public function recibirDocumentoSubsanacionRed($idUbi)
    {
        try {
            $ubi = reUbicacion::findOrFail($idUbi);
            $ref = reReferencia::findOrFail($ubi->rId);
            $ess = Eess::findOrFail($ref->idEssRef);
            $micro = MicroRed::findOrFail($ess->idMicroRed);
            $roe = reOficinaEntidad::where('idRed', '=', $micro->idRed)->first();
            $ubi->uEst = 2;
            $ubi->save();
            $ubi2 = new reUbicacion();
            $ubi2->rId = $ubi->rId;
            $ubi2->oEId = $roe->oEId;
            $ubi2->fRevEst = $ubi->fRevEst;
            $ubi2->fFecRevi = $ubi->fFecRevi;
            $ubi2->fFecRecep = UtilController::fecha();
            $ubi2->uUsuReg = Auth::user()->id;
            $ubi2->save();
            $rev = reRevision::where('uId', '=', $ubi->uId)->get();
            foreach ($rev as $rv) {
                $rev2 = new reRevision();
                $rev2->dFId = $rv->dFId;
                $rev2->uId = $ubi2->uId;
                $rev2->rEstFecRev = $rv->rEstFecRev;
                $rev2->rEstRev = $rv->rEstRev;
                $rev2->rUsuReg = $rv->rUsuReg;
                $rev2->save();
                if ($rv->rEstRev === 3) {
                    $obs1 = reObservacion::where('rId', '=', $rv->rId)->first();
                    $obs2 = new reObservacion();
                    $obs2->rId = $rev2->rId;
                    $obs2->oMotivo = $obs1->oMotivo . '. (no subsanado)';
                    $obs2->rUsuReg = $obs1->rUsuReg;
                    $obs2->save();
                }
            }
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), 'ReDocSubsanacionController', 'recibirDocumentoSubsanacion');
            return response()->json(array('error' => $e->getMessage()));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param \App\reDocSubsanacion $reDocSubsanacion
     * @return \Illuminate\Http\Response
     */
    public function show(reDocSubsanacion $reDocSubsanacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\reDocSubsanacion $reDocSubsanacion
     * @return \Illuminate\Http\Response
     */
    public function edit(reDocSubsanacion $reDocSubsanacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\reDocSubsanacion $reDocSubsanacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reDocSubsanacion $reDocSubsanacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\reDocSubsanacion $reDocSubsanacion
     * @return \Illuminate\Http\Response
     */
    public function destroy(reDocSubsanacion $reDocSubsanacion)
    {
        //
    }
}
