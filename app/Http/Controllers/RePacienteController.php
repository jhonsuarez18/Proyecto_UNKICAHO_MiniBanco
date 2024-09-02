<?php

namespace App\Http\Controllers;

use App\CentropobladoDistrito;
use App\Persona;
use App\rePaciente;
use App\rePacTipSeg;
use App\rePersonal;
use http\Client\Curl\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Usuario;

class RePacienteController extends Controller
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

    public function getPacienteDni($dni)
    {
        try {
            $pac = new rePaciente();
            $respp = $pac->getPacienteDni($dni);
            /// si no esta buscar en su salud o reniec
            $tipSeg = new rePacTipSeg();
            $respTs = $tipSeg->getTipSeg($respp->pId);
            return response()->json(array('error' => 0, 'paciente' => $respp, 'tipsSeg' => $respTs));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(), 'RePacienteController', 'getPacienteDni');
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
               /* if($sit==1){
                    if($idcpd!=='0'){
                    $centropd=CentroPobladoDistritoController::getExistcPD($iddist,$idcpd);
                   // $pers =  $centropd['centpd'];
                    if(count($centropd)==0){
                        dd('no esta registrado el centro poblado distrito');
                    }else{
                        dd('Si esta registrado el centro poblado distrito');
                        //dd(count($centropd));
                        //dd($centropd['cPDUsuReg']);
                        foreach ($centropd as $cpd) {
                            //dd($cpd->cPDUsuReg);
                        }
                    }
                    }else{
                        dd('El Paciente vive en una Ciudad');
                    }
                }*/
                if($request->sit==1){
                    if($request->idcp!=='0'){
                        $centropd=CentroPobladoDistritoController::getExistcPD($request->iddist,$request->idcp);

                    if(count($centropd)==0){
                     $centpd = new CentropobladoDistrito();
                     $centpd->idCentroPoblado = $request->idcp;
                     $centpd->idDistrito =$request->iddist;
                     $centpd->cPDUsuReg = Auth::user()->id;
                     $centpd->cPDFecCrea = UtilController::fecha();
                     $centpd->save();
                     $idcpd= $centpd->cPDId;
                    }else{
                        foreach ($centropd as $cpd) {
                            $idcpd=$cpd->cPDId;
                        }
                    }
                        $person = New Persona();

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
                        $idpersona= $person->idPersona;

                        $pac = new rePaciente();
                        $pac->idPersona =$idpersona;
                        $pac->pUsuReg = Auth::user()->id;
                        $pac->pFecCrea = UtilController::fecha();
                        $pac->save();
                        $idpac=$pac->pId;

                        $pactips=new rePacTipSeg();
                        $pactips->pId= $idpac;
                        $pactips->tSId= $request->tips;
                        $pactips->pTSUsuReg= Auth::user()->id;
                        $pactips->pTSFecCrea = UtilController::fecha();
                        $pactips->save();
                    }else{
                        $person = New Persona();

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
                        $person->fecNac =date('Y-m-d', strtotime($request->fecNac));
                        $person->fecActualiza = UtilController::fecha();
                        $person->usuActuali = Auth::user()->id;
                        $person->usuReg = Auth::user()->id;
                        $person->fecCreacion = UtilController::fecha();
                        $person->telefono = $request->telefono;
                        $person->save();
                        $idpersona= $person->idPersona;

                        $pac = new rePaciente();
                        $pac->idPersona =$idpersona;
                        $pac->pUsuReg = Auth::user()->id;
                        $pac->pFecCrea = UtilController::fecha();
                        $pac->save();
                        $idpac=$pac->pId;

                        $pactips=new rePacTipSeg();
                        $pactips->pId= $idpac;
                        $pactips->tSId= $request->tips;
                        $pactips->pTSUsuReg= Auth::user()->id;
                        $pactips->pTSFecCrea = UtilController::fecha();
                        $pactips->save();
                    }
                }else{
                    $pac = new rePaciente();
                    $pac->idPersona =$request->idperson;
                    $pac->pUsuReg = Auth::user()->id;
                    $pac->pFecCrea = UtilController::fecha();
                    $pac->save();
                    $idpac=$pac->pId;

                    $pactips=new rePacTipSeg();
                    $pactips->pId= $idpac;
                    $pactips->tSId= $request->tips;
                    $pactips->pTSUsuReg= Auth::user()->id;
                    $pactips->pTSFecCrea = UtilController::fecha();
                    $pactips->save();

                }

            });
            return response()->json(array('error' => 0));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"RePacienteController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\rePaciente $rePaciente
     * @return \Illuminate\Http\Response
     */
    public function show(rePaciente $rePaciente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\rePaciente $rePaciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                if($request->siti==1){

                    if($request->idcp!=='0'){
                        $centropd=CentroPobladoDistritoController::getExistcPD($request->iddist,$request->idcp);
                        if(count($centropd)==0){
                            $centpd = new CentropobladoDistrito();
                            $centpd->idCentroPoblado = $request->idcp;
                            $centpd->idDistrito =$request->iddist;
                            $centpd->cPDUsuReg = Auth::user()->id;
                            $centpd->cPDFecCrea = UtilController::fecha();
                            $centpd->save();
                            $idcpd= $centpd->cPDId;
                        }else{
                            foreach ($centropd as $cpd) {
                                $idcpd=$cpd->cPDId;
                            }
                        }
                    }
                   $person=Persona::findOrfail($request->idperson);

                    $person->idUser = null;
                    if($request->idcp!=='0'){
                        $person->idDistrito = null;
                        $person->cPDId = $idcpd;
                    }else{
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

                    $pac=rePaciente::findOrfail($request->idpac);
                    $pac->idPersona =$request->idperson;
                    $pac->pUsuReg = Auth::user()->id;
                    $pac->pFecCrea = UtilController::fecha();
                    $pac->save();

                    $pactips=rePacTipSeg::findOrfail($request->idpactips);
                    $pactips->pId= $request->idpac;
                    $pactips->tSId= $request->tips;
                    $pactips->pTSUsuReg= Auth::user()->id;
                    $pactips->pTSFecCrea = UtilController::fecha();
                    $pactips->save();
                }else{
                   if($request->idcp!=='0'){
                        $centropd=CentroPobladoDistritoController::getExistcPD($request->iddist,$request->idcp);

                        if(count($centropd)==0){
                            $centpd = new CentropobladoDistrito();
                            $centpd->idCentroPoblado = $request->idcp;
                            $centpd->idDistrito =$request->iddist;
                            $centpd->cPDUsuReg = Auth::user()->id;
                            $centpd->cPDFecCrea = UtilController::fecha();
                            $centpd->save();
                            $idcpd= $centpd->cPDId;
                        }else{
                            foreach ($centropd as $cpd) {
                                $idcpd=$cpd->cPDId;
                            }
                        }
                    }
                        $person=Persona::findOrfail($request->idperson);

                        $person->idUser = null;
                        if($request->idcp!=='0'){
                            $person->cPDId = $idcpd;
                        }else{
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

                        $pac=rePaciente::findOrfail($request->idpac);
                        $pac->idPersona =$request->idperson;
                        $pac->pUsuReg = Auth::user()->id;
                        $pac->pFecCrea = UtilController::fecha();
                        $pac->save();

                        $pactips=rePacTipSeg::findOrfail($request->idpactips);
                        $pactips->pId= $request->idpac;
                        $pactips->tSId= $request->tips;
                        $pactips->pTSUsuReg= Auth::user()->id;
                        $pactips->pTSFecCrea = UtilController::fecha();
                        $pactips->save();

                }

            });
            return response()->json(array('error' => 0));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"RePacienteController","edit");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\rePaciente $rePaciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, rePaciente $rePaciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\rePaciente $rePaciente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function () use ($id) {
                $pac=rePaciente::findOrfail($id);

                ($pac->pEst === 1) ? $pac->pEst = 0 : $pac->pEst = 1;
                $pac->pFecCrea = UtilController::fecha();
                $pac->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"RePacienteController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    function getPacienteRefDni($dni)
    {

        try {
            //$pacient= rePaciente::getPacienteDni($dni);
            $person = Persona::buscarPersonaDni($dni);
            //dd($person);
            //$personal = rePersonal::getPersonalDni($dni);
            $usuario = Usuario::getUsuarioDni($dni);
            //dd($person,$usuario);
            return response()->json(array('error' => 0,'person'=>$person,'usuario'=>$usuario));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"RePaciente","getPacienteRefDni");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getPacientes(){
        try{
            //dd(datatables(rePaciente::getPacientes())->make(true));
            Return datatables(rePaciente::getPacientes())->make(true);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"RePacienteController","getPacientes");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
