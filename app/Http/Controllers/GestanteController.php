<?php

namespace App\Http\Controllers;


use App\Gestante;
use App\gestanteSubActividad;
use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\Datatables\Datatables;

class GestanteController extends Controller
{
    public function verPadron()
    {
        try {
            return view('intranet.Convenios.segurointegralsalud.padron.gestantes.padronGestante');
        } catch (Exception $e) {
            return $e;
        }
    }

    public function verAgregarGestante()
    {
        try {
            return view('intranet.Convenios.segurointegralsalud.padron.gestantes.agregarGestantes');
        } catch (Exception $e) {
            return $e;
        }
    }

    public function verEditar($idgestante)
    {
        try {
            $gestante = Gestante::obtenerGestanteId($idgestante);
            return view('intranet.Convenios.segurointegralsalud.padron.gestantes.EditarGestante')->with('gestante', $gestante);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function mostrarActividadesGestante($idGestante)
    {
        try {
            $gestante = Gestante::obtenerGestante($idGestante);
            return view('intranet.Convenios.segurointegralsalud.padron.gestantes.controlesGestantes')->with('gestante', $gestante);
        } catch (Exception $e) {
            return $e;
        }
    }

    public function obtenerGestanteDni($dni)
    {
        try {
            $gestante = Gestante::obtenerGestanteDni($dni);
            return response()->json(array('error' => 0, 'gestante' => $gestante));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function registrarGestante(Request $request)
    {
        try {

            DB::transaction(function () use ($request) {
                if (empty($request->idpersona)) {
                    $persona = new Persona;
                    $persona->idUser = null;
                    $persona->telefono=$request->telefo;
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
                } else {
                    $idpersona = $request->idpersona;
                }
                $gestante = new Gestante;
                $gestante->idPersona = $idpersona;
                $gestante->idEss = $request->estate;
                $gestante->idCentroPoblado = $request->cenpo;
                $gestante->nroHistoria = $request->nrohistoria;
                $gestante->tipoSeguro = $request->tipseg;;
                $gestante->Lengua = $request->idiom;
                $gestante->estadoCivil = $request->estaciv;
                $gestante->gesta = $request->gest;
                $gestante->etnia = $request->etnia;
                $gestante->paridad = $request->pari;
                $gestante->nivelinstruc = $request->nivinstr;
                $gestante->fecUltiRegla = date('Y-m-d', strtotime($request->fecregla));;
                $gestante->fecProbParto = date('Y-m-d', strtotime($request->fecpart));
                $gestante->usuReg = Auth::user()->id;
                $gestante->fecCreacion = UtilController::fecha();
                $gestante->save();


            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }


    }

    public function obtenerGestantes($hist,$dni)
    {
        try {

            return Datatables::of(Gestante::obtenerGestantes(Auth::user()->idEss,$hist,$dni))->make(true);
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerControlgestante($idactividad, $idgestante)
    {
        try {
            return Datatables::of(Gestante::obtenerControlGestante($idgestante, $idactividad))->make(true);
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function registrarAtencion($array)
    {
        try {

            $data = json_decode($array);
            DB::transaction(function () use ($data) {
                $gesact = New Gestantesubactividad;
                $gesact->idSubActividad = $data->idsubact;
                $gesact->idGestante = $data->idgest;
                $gesact->ateEstado = 1;
                $gesact->usuCrea = Auth::user()->id;
                $gesact->fechaAtencion = date('Y-m-d', strtotime($data->fecate));
                $gesact->Resultado = $data->resultado;
                $gesact->observacion = $data->obs;
                $gesact->fecCreacion = UtilController::fecha();
                $gesact->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }

    }

    public function modificarVBG($array)
    {
        try {
            $data = json_decode($array);
            DB::transaction(function () use ($data) {
                Gestante::modificarTamizaje($data->idgest, date('Y-m-d', strtotime($data->fectami)), $data->result, Auth::user()->id);
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }

    }

    public function modificarGS($array)
    {
        try {
            $data = json_decode($array);
            DB::transaction(function () use ($data) {
                Gestante::modificarGrupoSanguineo($data->idgest, $data->grusan, $data->factor, Auth::user()->id);
            });
            return response()->json(array('error' => 0, 'grusan' => $data->grusan, 'factor' => $data->factor));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }

    }

    public function cambiarEstadoPuerpera($idgestante)
    {
        try {
            DB::transaction(function () use ($idgestante) {
                Gestante::modificarEstadoPartu($idgestante);
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function registrarParto($array)
    {
        try {
            $array = json_decode($array);
            DB::transaction(function () use ($array) {
                if (empty($array->fecate))
                    $fecate = null;
                else
                    $fecate = date('Y-m-d', strtotime($array->fecate));

                if (empty($array->fecnv)) {
                    $fecnv = null;
                    $tipcnv = null;
                } else {
                    $fecnv = date('Y-m-d', strtotime($array->fecnv));
                    $tipcnv = $array->tipcnv;
                }
                if (empty($array->fecabo))
                    $fecabo = null;
                else
                    $fecabo = date('Y-m-d', strtotime($array->fecabo));

                Gestante::modificarGestanteParto($array->idgest, $fecate, $array->vipa
                    , $tipcnv, $fecnv, $fecabo, $array->lupa, Auth::user()->id);
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }

    }

    public function cambiarDatosPuerperio($array)
    {
        try {
            $array = json_decode($array);
            DB::transaction(function () use ($array) {
                Gestante::modificarDatosPuerperio($array->idgest, $array->hemopu, $array->plapu);
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function cambiarObservaciones(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                Gestante::modificarDatosObservaciones($request->idgest, $request->noco, $request->teco, $request->observaciones);
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function editarGestante(Request $request)
    {
        try {

            DB::transaction(function () use ($request) {

                $persona = Persona::findOrFail($request->idpersona);
                $persona->idUser = null;
                $persona->telefono=$request->telefo;
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
                $gestante = Gestante::findOrFail($request->idgestante);
                $gestante->idEss = $request->estate;
                $gestante->idCentroPoblado = $request->cenpo;
                $gestante->nroHistoria = $request->nrohistoria;
                $gestante->tipoSeguro = $request->tipseg;;
                $gestante->Lengua = $request->idiom;
                $gestante->estadoCivil = $request->estaciv;
                $gestante->gesta = $request->gest;
                $gestante->etnia = $request->etnia;
                $gestante->paridad = $request->pari;
                $gestante->nivelinstruc = $request->nivinstr;
                $gestante->fecUltiRegla = date('Y-m-d', strtotime($request->fecregla));;
                $gestante->fecProbParto = date('Y-m-d', strtotime($request->fecpart));
                $gestante->usuReg = Auth::user()->id;
                $gestante->fecCreacion = UtilController::fecha();
                $gestante->save();


            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }


    }
}
