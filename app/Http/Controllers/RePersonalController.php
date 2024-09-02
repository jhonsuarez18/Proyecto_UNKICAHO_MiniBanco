<?php

namespace App\Http\Controllers;

use App\CentropobladoDistrito;
use App\Persona;
use App\reDocFile;
use App\reDocumento;
use App\reOficinaEntidad;
use App\rePaciente;
use App\rePersonal;
use App\reReferencia;
use App\reRefPer;
use App\reRevision;
use App\reUbicacion;
use App\reUsuOfi;
use App\ViGasto;
use App\ViViatico;
use Hamcrest\Util;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RePersonalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     *
     *
     *
     *
     */


    public function getPersonal(Request $request)
    {
        try {
            $term = $request->input('term');
            return rePersonal::getPersonal($term);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), 'RePersonalController', 'getPersonal');
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function addeditper($idp, $idr)
    {
        try {
            DB::transaction(function () use ($idr, $idp) {
                $diag = reRefPer::where(['pId' => $idp, 'RId' => $idr])->first();
                if ($diag)
                    $this->destroyPersonalRef($idp, $idr);
                else {
                    $ubi = reUbicacion::where(['rId' => $idr, 'oEId' => 13, 'fRevEst' => 0])->first();
                    $rrp = new reRefPer();
                    $rrp->pId = $idp;
                    $rrp->RId = $idr;
                    $rrp->rPUsuReg = Auth::user()->id;
                    $rrp->rPFecCrea = UtilController::fecha();
                    $rrp->save();
                    $per = new rePersonal();
                    $personal = $per->getPersona($idp);
                    $file = new reDocFile();
                    $file->rId = $idr;
                    $file->dId = 1;
                    $file->dFDescripcion = 'VIATICOS ' . $personal->apPaterno . ' ' . $personal->apMaterno . ', ' .
                        $personal->pNombre . ' ' . $personal->sNombre;
                    $file->dFUsuReg = Auth::user()->id;
                    $file->save();
                    $viatico = new ViViatico();
                    $viatico->dFId = $file->dFId;
                    $viatico->pId = $idp;
                    $viatico->vUsu = Auth::user()->id;
                    $viatico->save();
                    $rev = new reRevision();
                    $rev->dFId = $file->dFId;
                    $rev->uId = $ubi->uId;
                    $rev->rEstRev = 0;
                    $rev->rUsuReg = Auth::user()->id;
                    $rev->save();
                }
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "RePersonalController", "addeditper");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function destroyPersonalRef($id, $rid)
    {
        try {
            DB::transaction(function () use ($id, $rid) {
                $pers = reRefPer::where(['pId' => $id, 'RId' => $rid])->first();
                ($pers->rPEst === 1) ? $pers->rPEst = 0 : $pers->rPEst = 1;
                $pers->rPFecCrea = UtilController::fecha();
                $pers->save();
                $refpe = new reRefPer();
                $getViDoc = $refpe->getViatDoc($rid, $id);
                $reDocFile = reDocFile::findOrFail($getViDoc->dFId);
                ($reDocFile->dFEst === 1) ? $reDocFile->dFEst = 0 : $reDocFile->dFEst = 1;
                $reDocFile->save();
                $viatico = ViViatico::findOrFail($getViDoc->vId);
                ($viatico->vEst === 1) ? $viatico->vEst = 0 : $viatico->vEst = 1;
                $viatico->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "RePersonalController", "destroyPersonalRef");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function storePersonalRecib($idv, $idr)
    {
        // idv, idr, pid
        try {
            DB::transaction(function () use ($idv, $idr) {
                // registro personal referencia, personal
                $refer = reReferencia::findOrFail($idr);
                $usuof = reUsuOfi::where('id', '=', $refer->rUsuReg)->first();
                $oe = reOficinaEntidad::where('oEId', '=', $usuof->oEId)->first();
                $ubi = new reUbicacion();
                $ubi->oEId = $oe->oEId;
                $ubi->rId = $idr;
                $ubi->fRevEst = 0;
                $ubi->fFecRecep = UtilController::fecha();
                $ubi->uUsuReg = Auth::user()->id;
                $ubi->save();
                $refp = reRefPer::where(['RId' => $idr, 'rPEst' => 1])->get();
                foreach ($refp as $ref) {
                    $per = new rePersonal();
                    $personal = $per->getPersona($ref->pId);
                    $file = new reDocFile();
                    $file->rId = $idr;
                    $file->dId = 1;
                    $file->dFDescripcion = 'VIATICOS ' . $personal->apPaterno . ' ' . $personal->apMaterno . ', ' .
                        $personal->pNombre . ' ' . $personal->sNombre;
                    $file->dFUsuReg = Auth::user()->id;
                    $file->save();
                    $viatico = new ViViatico();
                    $viatico->dFId = $file->dFId;
                    $viatico->pId = $ref->pId;
                    $viatico->vUsu = Auth::user()->id;
                    $viatico->save();
                    $rev = new reRevision();
                    $rev->dFId = $file->dFId;
                    $rev->uId = $ubi->uId;
                    $rev->rEstRev = 0;
                    $rev->rUsuReg = Auth::user()->id;
                    $rev->save();
                }
                $docs = reDocumento::all()->where('dId', '!=', 1)->where('dEst', '=', 1);
                foreach ($docs as $doc) {
                    if ($idv !== null) {
                        $file = new reDocFile();
                        $file->rId = $idr;
                        $file->dId = $doc->dId;
                        $file->dFDescripcion = $doc->dTitulo;
                        $file->dFUsuReg = Auth::user()->id;
                        $file->save();
                        $rev = new reRevision();
                        $rev->dFId = $file->dFId;
                        $rev->uId = $ubi->uId;
                        $rev->rEstRev = 0;
                        $rev->rUsuReg = Auth::user()->id;
                        $rev->save();
                    } else {
                        if (!in_array($doc->dId, [3, 12, 14])) {
                            $file = new reDocFile();
                            $file->rId = $idr;
                            $file->dId = $doc->dId;
                            $file->dFDescripcion = $doc->dTitulo;
                            $file->dFUsuReg = Auth::user()->id;
                            $file->save();
                            $rev = new reRevision();
                            $rev->dFId = $file->dFId;
                            $rev->uId = $ubi->uId;
                            $rev->rEstRev = 0;
                            $rev->rUsuReg = Auth::user()->id;
                            $rev->save();
                        }
                    }
                }
            });
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), 'RePersonalController', 'storePersonalRecib');
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function index()
    {
        try {
            $vi = 1;
            return view('intranet.combustible.chofer')->with(array('vi' => $vi));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "RePersonalController", "index");
            return response(array('error' => $e->getMessage()));
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
            DB::transaction(function () use ($request) {
                if ($request->sit == 1) {
                    if ($request->idcp !== '0') {
                        $centropd = CentroPobladoDistritoController::getExistcPD($request->iddist, $request->idcp);

                        if (count($centropd) == 0) {
                            $centpd = new CentropobladoDistrito();
                            $centpd->idCentroPoblado = $request->idcp;
                            $centpd->idDistrito = $request->iddist;
                            $centpd->cPDUsuReg = Auth::user()->id;
                            $centpd->cPDFecCrea = UtilController::fecha();
                            $centpd->save();
                            $idcpd = $centpd->cPDId;
                        } else {
                            foreach ($centropd as $cpd) {
                                $idcpd = $cpd->cPDId;
                            }
                        }
                        $person = new Persona();

                        $person->idUser = null;
                        $person->cPDId = $idcpd;
                        $person->pNombre = $request->pnombre;
                        $person->sNombre = $request->snombre;
                        $person->apPaterno = $request->appaterno;
                        $person->apMaterno = $request->apmaterno;
                        $person->numeroDoc = $request->numdoc;
                        $person->tipoDoc = $request->tipdoc;
                        $person->direccion = $request->direccion;
                        $person->referencia = $request->referencia;
                        $person->fecNac = date('Y-m-d', strtotime($request->fecNac));
                        $person->fecActualiza = UtilController::fecha();;
                        $person->usuActuali = Auth::user()->id;
                        $person->usuReg = Auth::user()->id;
                        $person->fecCreacion = UtilController::fecha();
                        $person->telefono = $request->telefono;
                        $person->save();
                        $idpersona = $person->idPersona;

                        $pers = new rePersonal();

                        $pers->idPersona = $idpersona;
                        $pers->oEId = $request->idoe;
                        $pers->tPId = $request->idtipp;
                        $pers->pColegiatura = $request->coleg;
                        $pers->pEspecialidad = $request->espec;
                        $pers->pUsuReg = Auth::user()->id;
                        $pers->pFecCrea = UtilController::fecha();
                        $pers->save();
                    } else {
                        $person = new Persona();

                        $person->idUser = null;
                        $person->idDistrito = $request->iddist;
                        $person->pNombre = $request->pnombre;
                        $person->sNombre = $request->snombre;
                        $person->apPaterno = $request->appaterno;
                        $person->apMaterno = $request->apmaterno;
                        $person->numeroDoc = $request->numdoc;
                        $person->tipoDoc = $request->tipdoc;
                        $person->direccion = $request->direccion;
                        $person->referencia = $request->referencia;
                        $person->fecNac = date('Y-m-d', strtotime($request->fecNac));
                        $person->fecActualiza = UtilController::fecha();
                        $person->usuActuali = Auth::user()->id;
                        $person->usuReg = Auth::user()->id;
                        $person->fecCreacion = UtilController::fecha();
                        $person->telefono = $request->telefono;
                        $person->save();
                        $idpersona = $person->idPersona;

                        $pers = new rePersonal();

                        $pers->idPersona = $idpersona;
                        $pers->oEId = $request->idoe;
                        $pers->tPId = $request->idtipp;
                        $pers->pColegiatura = $request->coleg;
                        $pers->pEspecialidad = $request->espec;
                        $pers->pUsuReg = Auth::user()->id;
                        $pers->pFecCrea = UtilController::fecha();
                        $pers->save();
                    }
                } else {
                    $pers = new rePersonal();

                    $pers->idPersona = $request->idperson;
                    $pers->oEId = $request->idoe;
                    $pers->tPId = $request->idtipp;
                    $pers->pColegiatura = $request->coleg;
                    $pers->pEspecialidad = $request->espec;
                    $pers->pUsuReg = Auth::user()->id;
                    $pers->pFecCrea = UtilController::fecha();
                    $pers->save();

                }
                /*$pers=New rePersonal();

                $pers->idPersona=$request->idper;
                $pers->oEId=$request->idoe;
                $pers->tPId=$request->idtipp;
                $pers->pColegiatura=$request->coleg;
                $pers->pEspecialidad=$request->espec;
                $pers->pUsuReg = Auth::user()->id;
                $pers->pFecCrea = UtilController::fecha();
                $pers->save();*/
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "RePersonalController", "store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\rePersonal $rePersonal
     * @return \Illuminate\Http\Response
     */
    public function show(rePersonal $rePersonal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\rePersonal $rePersonal
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                if ($request->siti == 1) {

                    if ($request->idcp !== '0') {
                        $centropd = CentroPobladoDistritoController::getExistcPD($request->iddist, $request->idcp);
                        if (count($centropd) == 0) {
                            $centpd = new CentropobladoDistrito();
                            $centpd->idCentroPoblado = $request->idcp;
                            $centpd->idDistrito = $request->iddist;
                            $centpd->cPDUsuReg = Auth::user()->id;
                            $centpd->cPDFecCrea = UtilController::fecha();
                            $centpd->save();
                            $idcpd = $centpd->cPDId;
                        } else {
                            foreach ($centropd as $cpd) {
                                $idcpd = $cpd->cPDId;
                            }
                        }
                    }
                    $person = Persona::findOrfail($request->idperson);

                    $person->idUser = null;
                    if ($request->idcp !== '0') {
                        $person->idDistrito = null;
                        $person->cPDId = $idcpd;
                    } else {
                        $person->idDistrito = $request->iddist;
                    }
                    $person->pNombre = $request->pnombre;
                    $person->sNombre = $request->snombre;
                    $person->apPaterno = $request->appaterno;
                    $person->apMaterno = $request->apmaterno;
                    $person->numeroDoc = $request->numdoc;
                    $person->tipoDoc = $request->tipdoc;
                    $person->direccion = $request->direccion;
                    $person->referencia = $request->referencia;
                    $person->fecNac = date('Y-m-d', strtotime($request->fecNac));
                    $person->fecActualiza = UtilController::fecha();;
                    $person->usuActuali = Auth::user()->id;
                    $person->usuReg = Auth::user()->id;
                    $person->fecCreacion = UtilController::fecha();
                    $person->telefono = $request->telefono;
                    $person->save();

                    $pers = rePersonal::findOrfail($request->idpers);

                    $pers->idPersona = $request->idperson;
                    $pers->oEId = $request->idoe;
                    $pers->tPId = $request->idtipp;
                    $pers->pColegiatura = $request->coleg;
                    $pers->pEspecialidad = $request->espec;
                    $pers->pUsuReg = Auth::user()->id;
                    $pers->pFecCrea = UtilController::fecha();
                    $pers->save();

                } else {
                    if ($request->idcp !== '0') {
                        $centropd = CentroPobladoDistritoController::getExistcPD($request->iddist, $request->idcp);

                        if (count($centropd) == 0) {
                            $centpd = new CentropobladoDistrito();
                            $centpd->idCentroPoblado = $request->idcp;
                            $centpd->idDistrito = $request->iddist;
                            $centpd->cPDUsuReg = Auth::user()->id;
                            $centpd->cPDFecCrea = UtilController::fecha();
                            $centpd->save();
                            $idcpd = $centpd->cPDId;
                        } else {
                            foreach ($centropd as $cpd) {
                                $idcpd = $cpd->cPDId;
                            }
                        }
                    }
                    $person = Persona::findOrfail($request->idperson);

                    $person->idUser = null;
                    if ($request->idcp !== '0') {
                        $person->cPDId = $idcpd;
                    } else {
                        $person->idDistrito = $request->iddist;
                        $person->cPDId = null;
                    }
                    $person->pNombre = $request->pnombre;
                    $person->sNombre = $request->snombre;
                    $person->apPaterno = $request->appaterno;
                    $person->apMaterno = $request->apmaterno;
                    $person->numeroDoc = $request->numdoc;
                    $person->tipoDoc = $request->tipdoc;
                    $person->direccion = $request->direccion;
                    $person->referencia = $request->referencia;
                    $person->fecNac = date('Y-m-d', strtotime($request->fecNac));
                    $person->fecActualiza = UtilController::fecha();;
                    $person->usuActuali = Auth::user()->id;
                    $person->usuReg = Auth::user()->id;
                    $person->fecCreacion = UtilController::fecha();
                    $person->telefono = $request->telefono;
                    $person->save();

                    $pers = rePersonal::findOrfail($request->idpers);

                    $pers->idPersona = $request->idperson;
                    $pers->oEId = $request->idoe;
                    $pers->tPId = $request->idtipp;
                    $pers->pColegiatura = $request->coleg;
                    $pers->pEspecialidad = $request->espec;
                    $pers->pUsuReg = Auth::user()->id;
                    $pers->pFecCrea = UtilController::fecha();
                    $pers->save();
                }
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "RePersonalController", "edit");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\rePersonal $rePersonal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rePersonal $rePersonal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\rePersonal $rePersonal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $pers = rePersonal::findOrfail($id);

                ($pers->pEst === 1) ? $pers->pEst = 0 : $pers->pEst = 1;
                $pers->pFecCrea = UtilController::fecha();
                $pers->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "RePersonalController", "destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function getPersonals()
    {
        try {
            return datatables(rePersonal::getPersonals())->make(true);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "RePersonalController", "getPersonals");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function getChoferes()
    {
        try {
            return datatables(rePersonal::getChoferes())->make(true);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "RePersonalController", "getChoferes");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function getPersonalEdit($id)
    {
        try {
            $pers = rePersonal::getPersonalEdit($id);
            return response()->json(array('error' => 0, 'pers' => $pers));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "RePersonalController", "getPersonalEdit");
            return response()->json(array('error' => $e->getMessage()));
        }

    }

    public function validarPersonal($idp)
    {
        try {
            $pers = rePersonal::where(['idPersona' => $idp])->select('pId', 'idPersona', 'oEId', 'pEst')->orderby('pFecCrea')->get();
            return response()->json(array('error' => 0, 'per' => $pers));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "RePersonalController", "validarPersonal");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    function getChoferDni($dni)
    {
        try {
            $chofer = rePersonal::getChoferDni($dni);
            return response()->json(array('error' => 0, 'chofer' => $chofer));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(), "RePersonalController", "getChoferDni");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
