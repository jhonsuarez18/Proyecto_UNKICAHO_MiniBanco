<?php

namespace App\Http\Controllers;

use App\atencion;
use App\contactovisita;
use App\EntregaEpp;
use App\entregaepppaciente;
use App\epp;
use App\Gestante;
use App\Lugarvisitacontactovisita;
use App\Lugarvisitapaciente;
use App\Morbilidad;
use App\MorbilidadPacienteCovid;
use App\pacientecovid;
use App\Persona;
use App\Sintoma;
use App\SintomaAtencion;
use App\UbicacionModel;
use Hamcrest\Util;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;

class covid19controller extends Controller
{
    public function index()
    {
        try {
            return view('intranet.Covid.covid');
        } catch (Exception $e) {
            return $e;
        }
    }

    public function verEditarPacienteCovid($idpaciente)
    {
        try {
            $result = pacientecovid::editarPacienteIdPaciente($idpaciente);
            return view('intranet.Covid.editarpacientecovid')->with('result', $result);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function seguimientoCovid()
    {
        try {
            return view('intranet.Covid.seguimientocovid');
        } catch (Exception $e) {
            return $e;
        }
    }

    public function verruta($idPaciente)
    {
        try {
            return view('intranet.Covid.rutacovid')->with('idpaciente', $idPaciente);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function mostrarRegistrarCovid($idcontactovisita, $idpaciente)
    {
        try {
            return view('intranet.Covid.agregarpacientecovid')->with(['idpaciente' => $idpaciente, 'idcontactovisita' => $idcontactovisita]);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function editarPacienteCovid(Request $request)
    {
        try {

            DB::transaction(function () use ($request) {
                $pacientecovid = Pacientecovid::findOrFail($request->idpaciente);
                // $pacientecovid->idDistrito = $request->discon;
                //$pacientecovid->direccion = $request->cenpo;
                //$pacientecovid->fecExamen = date('Y-m-d', strtotime($request->fecdiag));;
                // $pacientecovid->fecSintIni = date('Y-m-d', strtotime($request->fecsinini));;
                // $pacientecovid->estadoPrueba = $request->estprueb;
                $pacientecovid->usuReg = Auth::user()->id;
                $pacientecovid->fecCreacion = UtilController::fecha();
                $pacientecovid->save();
                $idpersona = $pacientecovid->idPersona;
                $persona = Persona::findOrFail($idpersona);
                $persona->idUser = null;
                $persona->telefono = $request->telefo;
                $persona->idDistrito = $request->iddis;
                $persona->pNombre = $request->pnombre;
                $persona->sNombre = $request->snombre;
                $persona->apPaterno = $request->appaterno;
                $persona->apMaterno = $request->apmaterno;
                $persona->numeroDoc = $request->dni;
                $persona->tipoDoc = $request->tipdoc;
                $persona->direccion = $request->dir;
                $persona->referencia = $request->ref;
                // $persona->fecNac = date('Y-m-d', strtotime($request->fecnac));
                $persona->usuReg = Auth::user()->id;
                $persona->fecActualiza = UtilController::fecha();
                $persona->usuActuali = Auth::user()->id;
                $persona->fecCreacion = UtilController::fecha();
                $persona->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function agregarMorbilidad(Request $request)
    {
        try {
            if (empty(Morbilidad::obtenerMorbilidadIDpacienteMorbilidad($request->idpaciente, $request->morbilidad))) {
                $idmorbi = Morbilidad::obtenerMorbilidadId($request->morbilidad);
                DB::transaction(function () use ($request) {
                    if (empty($idmorbi)) {
                        $morbilidad = New Morbilidad;
                        $morbilidad->descripcion = $request->morbilidad;
                        $morbilidad->usuReg = Auth::user()->id;
                        $morbilidad->fecCreacion = UtilController::fecha();
                        $morbilidad->save();
                        $idmorbi = $morbilidad->idMorbilidad;
                    }
                    $morbilidadpaciente = new MorbilidadPacienteCovid;
                    $morbilidadpaciente->idMorbilidad = $idmorbi;
                    $morbilidadpaciente->idPacienteCovid = $request->idpaciente;
                    $morbilidadpaciente->usuReg = Auth::user()->id;
                    $morbilidadpaciente->fecCreacion = UtilController::fecha();
                    $morbilidadpaciente->save();
                });
                return response()->json(array('error' => 0));
            } else {
                DB::transaction(function () use ($request) {
                    $query = Morbilidad::obtenerMorbilidadIDpacienteMorbilidad($request->idpaciente, $request->morbilidad);
                    $morbilidadpaciente = MorbilidadPacienteCovid::findOrFail($query->idMorbilidadpacientecovid);
                    $morbilidadpaciente->estado = 1;
                    $morbilidadpaciente->usuReg = Auth::user()->id;
                    $morbilidadpaciente->fecCreacion = UtilController::fecha();
                    $morbilidadpaciente->save();
                });
                return response()->json(array('error' => 'La morbilidad ya esta agregada'));
            }
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function eliminarMorbilidad(Request $request)
    {
        try {

            DB::transaction(function () use ($request) {
                $morbilidadpaciente = MorbilidadPacienteCovid::findOrFail($request->idmorb);
                $morbilidadpaciente->estado = 0;
                $morbilidadpaciente->usuReg = Auth::user()->id;
                $morbilidadpaciente->fecCreacion = UtilController::fecha();
                $morbilidadpaciente->save();
            });
            return response()->json(array('error' => 0));

        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }


    public function registrarPacienteCovid(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                ///persona
                $persona = new Persona;
                $persona->idUser = null;
                $persona->telefono = $request->telefo;
                $persona->idDistrito = $request->iddis;
                $persona->pNombre = $request->pnombre;
                $persona->sNombre = $request->snombre;
                $persona->apPaterno = $request->appaterno;
                $persona->apMaterno = $request->apmaterno;
                $persona->numeroDoc = $request->dni;
                $persona->tipoDoc = $request->tipdoc;
                $persona->direccion = $request->dir;
                $persona->referencia = $request->ref;
                $persona->fecNac = date('Y-m-d', strtotime($request->fecnac));
                $persona->usuReg = Auth::user()->id;
                $persona->fecActualiza = UtilController::fecha();
                $persona->usuActuali = Auth::user()->id;
                $persona->fecCreacion = UtilController::fecha();
                $persona->save();
                $idpersona = $persona->idPersona;
                //paciente covid
                $pacientecovid = new pacientecovid;
                $pacientecovid->idPersona = $idpersona;
                // $pacientecovid->idDistrito = $request->discon;
                $pacientecovid->idEsstaboficina = $request->ofici;
                $pacientecovid->direccion = $request->cenpo;
                $pacientecovid->fecExamen = date('Y-m-d', strtotime($request->fecdiag));;
                $pacientecovid->fecSintIni = date('Y-m-d', strtotime($request->fecsinini));;
                $pacientecovid->estadoPrueba = $request->estprueb;
                $pacientecovid->usuReg = Auth::user()->id;
                $pacientecovid->fecCreacion = UtilController::fecha();
                $pacientecovid->save();
                $idpacientecovit = $pacientecovid->idPacienteCovid;
                //contacto visita
                if ($request->idcontactovisita != '0') {
                    $contactovisita = contactovisita::findOrFail($request->idcontactovisita);
                    $contactovisita->idPersona = $idpersona;
                    $contactovisita->save();
                }
                ////agregar morbilidad paciente
                IF (!empty($request->list)) {
                    foreach ($request->list as $morbi) {
                        $idmorbi = Morbilidad::obtenerMorbilidadId($morbi);
                        if (empty($idmorbi)) {
                            $morbilidad = New Morbilidad;
                            $morbilidad->descripcion = $morbi;
                            $morbilidad->usuReg = Auth::user()->id;
                            $morbilidad->fecCreacion = UtilController::fecha();
                            $morbilidad->save();
                            $idmorbi = $morbilidad->idMorbilidad;
                        }
                        $morbilidadpaciente = new MorbilidadPacienteCovid;
                        $morbilidadpaciente->idMorbilidad = $idmorbi;
                        $morbilidadpaciente->idPacienteCovid = $idpacientecovit;
                        $morbilidadpaciente->usuReg = Auth::user()->id;
                        $morbilidadpaciente->fecCreacion = UtilController::fecha();
                        $morbilidadpaciente->save();
                    }
                }

            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function reportarPacienyeCovid()
    {
        try {
            return Datatables::of(pacientecovid::reportarCasosCovid())->make(true);
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public
    function registrarLugaresPaciente(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $lugarvisitapaciente = new Lugarvisitapaciente;
                $lugarvisitapaciente->idDistrito = $request->dis;
                $lugarvisitapaciente->idPacienteCovid = $request->idpaciente;
                $lugarvisitapaciente->actividad = $request->activid;
                $lugarvisitapaciente->fecVisita = date('Y-m-d', strtotime($request->fecreu));
                $lugarvisitapaciente->usuReg = Auth::user()->id;
                $lugarvisitapaciente->fecCreacion = UtilController::fecha();
                $lugarvisitapaciente->save();
                $idlvi = $lugarvisitapaciente->idLugarVisitaPaciente;
                foreach ($request->contactos as $cont) {
                    $idcontacto = contactovisita::buscarContacto($cont, $request->idpaciente);
                    if (empty($idcontacto)) {
                        $contactovisita = new contactovisita;
                        $contactovisita->descripcion = $cont;
                        $contactovisita->usuReg = Auth::user()->id;
                        $contactovisita->fecCreacion = UtilController::fecha();;
                        $contactovisita->save();
                        $idContactoVisita = $contactovisita->idContactoVisita;
                        $lugarvisicont = new Lugarvisitacontactovisita;
                        $lugarvisicont->idContactoVisita = $idContactoVisita;
                        $lugarvisicont->idLugarVisitaPaciente = $idlvi;
                        $lugarvisicont->usuReg = Auth::user()->id;
                        $lugarvisicont->fecCreacion = UtilController::fecha();
                        $lugarvisicont->save();
                    } else {
                        $lugarvisicont = new Lugarvisitacontactovisita;
                        $lugarvisicont->idContactoVisita = $idcontacto;
                        $lugarvisicont->idLugarVisitaPaciente = $idlvi;
                        $lugarvisicont->usuReg = Auth::user()->id;
                        $lugarvisicont->fecCreacion = UtilController::fecha();
                        $lugarvisicont->save();
                    }
                }
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public
    function obetnerMovimientos($idpaciente)
    {
        try {
            $result = Lugarvisitapaciente::obtenerRuta($idpaciente);
            return response()->json(array('error' => 0, 'result' => $result));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public
    function obtenerPacienteCovidDni($dni)
    {
        try {
            $result = pacientecovid::buscarPacienteCovidDni($dni);
            return response()->json(array('error' => 0, 'result' => $result));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public
    function obtenerPacienteCoviddIdPaciente($idpaciente)
    {
        try {
            $result = pacientecovid::buscarPacienteCovidIdPaciente($idpaciente);
            return response()->json(array('error' => 0, 'result' => $result));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function registrarContactoPaciente(Request $request)
    {
        try {
            $contactovisita = contactovisita::findOrFail($request->idcontactovisita);
            $contactovisita->idPersona = $request->idpersona;
            $contactovisita->save();
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function contactosidnetificados($idpaciente)
    {
        try {
            return Datatables::of(contactovisita::contactosIdnetificados($idpaciente))->make(true);
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function cambiarEstado($idpaciente, $estado)
    {
        try {
            $pacientecovid = Pacientecovid::findOrFail($idpaciente);
            $pacientecovid->estadoPrueba = $estado;
            $pacientecovid->fecExamen = UtilController::fecha();
            $pacientecovid->save();
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }


    public function autoCompletarMorbilidad(Request $request)
    {
        try {
            $term = $request->input('term');
            return Morbilidad::obtenerMorbilidad($term);
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }

    }

    public function obtenerMorbilidad($idPaciente)
    {
        try {
            return response()->json(array('error' => 0, 'result' => Morbilidad::obtenerMorbilidadLsita($idPaciente)));

        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function reportarAtencionesDiariasCovid($array)
    {
        try {

            if ($array === '0') {
                $fecha = 'now()';
                return Datatables::of(pacientecovid::reportarAtencionesDiariasCovid($fecha))->make(true);
            } else {
                $data = json_decode($array);
                $fecha = date('Y-m-d', strtotime($data->fecbus));
                return Datatables::of(pacientecovid::reportarAtencionesDiariasCovid('"' . $fecha . '"'))->make(true);
            }
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerSintomas()
    {
        try {
            $result = Sintoma::obtenerSintomas();
            return response()->json(array('error' => 0, 'result' => $result));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function registraAtencion(Request $request)
    {
        try {
            /*$epp=EntregaEpp::select('Cantidad')->where('idEntregaEpp','=',$lis)->first();
            dd($epp->Cantidad);*/
            DB::transaction(function () use ($request) {

                $atencion = new Atencion;
                $atencion->idPacienteCovid = $request->idpaciente;
                $atencion->Detalles = $request->obs;
                $atencion->usuReg = Auth::user()->id;
                if (empty($request->fecbusq))
                    $atencion->fecCreacion = UtilController::fecha();
                else
                    $atencion->fecCreacion = date('Y-m-d', strtotime($request->fecbusq));
                $atencion->save();
                if (!empty($request->listidsepps)) {
                    foreach ($request->listidsepps as $listepp=>$lis) {
                        $entpaci = new entregaepppaciente;
                        $entpaci->idEntregaEpp = $lis;
                        foreach ($request->listcantiepp as $lista1=>$lis1){
                            if($listepp===$lista1){
                                if($lis1==='0'){
                                    $epp=EntregaEpp::select('Cantidad')->where('idEntregaEpp','=',$lis)->first();
                                    $entpaci->Cantidad = $epp->Cantidad;
                                }else{
                                    $entpaci->Cantidad = $lis1;
                                }
                            }
                        }
                        $entpaci->idPacienteCovid = $request->idpaciente;
                        $entpaci->usuReg = Auth::user()->id;
                        $entpaci->fecCreacion = UtilController::fecha();
                        $entpaci->save();
                    }
                }
                $idatencion = $atencion->idAtencion;
                if (!empty($request->listasintom)) {
                    foreach ($request->listasintom as $lista) {
                        $sintaten = new SintomaAtencion;
                        $sintaten->idSintoma = $lista;
                        $sintaten->idAtencion = $idatencion;
                        $sintaten->usuReg = Auth::user()->id;
                        $sintaten->fecCreacion = UtilController::fecha();
                        $sintaten->save();
                    }
                }

            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function verHistorialClinico($idpaciente)
    {
        try {
            return view('intranet.Covid.reportarHistorial')->with(['idpaciente' => $idpaciente,]);
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function verAtencionesPaciente($idpaciente)
    {
        try {
            return Datatables::of(pacientecovid::reportarAtenciones($idpaciente))->make(true);
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function entregarEpp($idpaciente)
    {
        try {
            $reult = EntregaEpp::obtenerEpp();
            $entregaEpp = new entregaepppaciente();
            $entregaEpp->idEntregaEpp = $reult;
            $entregaEpp->idPacienteCovid = $idpaciente;
            $entregaEpp->usuReg = Auth::user()->id;
            $entregaEpp->fecCreacion = UtilController::fecha();
            $entregaEpp->save();
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function crearEntregaApp(Request $request)
    {
        try {

            if (!empty($request->listidseppsentr)) {
                foreach ($request->listidseppsentr as $lista=>$lis) {
                    $entregaEpp = new EntregaEpp();
                    $entregaEpp->idEpp = $lis;
                    foreach ($request->listcantepp as $lista1=>$lis1){
                        if($lista===$lista1){
                            $entregaEpp->Cantidad = $lis1;
                        }
                    }
                    $entregaEpp->fecentregar = UtilController::fecha();
                    $entregaEpp->usuReg = Auth::user()->id;
                    $entregaEpp->fecCreacion = UtilController::fecha();
                    $entregaEpp->save();
                }
            }

            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerEntregaEpp($idpaciente)
    {
        try {
            return Datatables::of(EntregaEpp::obtenerEntregasEpp($idpaciente))->make(true);
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerEpps($idpaciente)
    {
        try {

            $result = epp::obtenerEpps($idpaciente);
            return response()->json(array('error' => 0, 'result' => $result));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }
    public function getEppsUni($idpaciente)
    {
        try {

            $result = epp::obtenerEppsUni($idpaciente);
            return response()->json(array('error' => 0, 'result' => $result));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }
    public function getEpps(){

        try {

            $result = Epp::where('estado',1)->get();
            return response()->json(array('error' => 0, 'result' => $result));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    //REPORTES
    public function getreportentregaeppgeneral()
    {
        return Datatables::of(entregaepppaciente::getReportEntregaEppGeneral())->make(true);
    }
    public function getreportfechaentre($fecha)
    {
        return Datatables::of(entregaepppaciente::getReportentregaFecha($fecha))->make(true);
    }
}
