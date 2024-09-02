<?php

namespace App\Http\Controllers;

use App\permiso;
use App\Persona;
use App\role_user;
use App\User;
use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\Auth;

class UsuarioController extends Controller
{
    public function index()
    {
        try {
            return view('intranet.Convenios.segurointegralsalud.datos.usuario');
        } catch (Exception $e) {

        }
    }

    public function registrar()
    {
        try {
            return view('intranet.Convenios.segurointegralsalud.datos.registrarUsuario');
        } catch (Exception $e) {

        }
    }

    public function reportarUsuario()

    {
        try {
            return Datatables::of(Usuario::reportarUsuarios())->make(true);
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerRoles()
    {
        try {

            $roll = Usuario::obtenerRoles();
            return response()->json(array('error' => 0, 'roll' => $roll));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function subirArchivo(Request $request)
    {
       try {
            $usuario = User::findOrFail($request->id);
            $usuario->name = $request->nombre;
            $usuario->email = $request->email;
            $usuario->updated_at = UtilController::fecha();
            if ($request->hasFile('archivo')) {
                $file = $request->file('archivo');
                $fileName = 'profile_' . $request->nombre . '-' . $request->email . UtilController::fecha() . '.' . $file->getClientOriginalExtension();
                $usuario->imagen = '/perfiles/' . $fileName;
                $file->storeAs('perfiles', $fileName);
            } else {
                $usuario->imagen = '/perfiles/user_default.png';
            }

            if (!empty($request->contra2)) {
                $usuario->password = bcrypt($request->contra2);
            }

            $usuario->save();
            if ($request->user()->hasAnyRole(['INTRANET'])) {
                return view('intranet.home');
            } else {
                if ($request->user()->hasAnyRole(['VISITADOR'])) {
                    return view('index');
                }
            }
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "UsuarioController", "subirArchivo");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function insertarUsuario(Request $request)
    {
        try {
           DB::transaction(function () use ($request) {
               //dd($request);
                $usuario = new Usuario();
                $usuario->name = $request->nombre;
                $usuario->email = $request->correo;
                $usuario->password = bcrypt('ROOT');
                $usuario->created_at = UtilController::fecha();
                $usuario->updated_at = UtilController::fecha();
                $usuario->imagen = '/perfiles/user_default.png';
                $usuario->estado = 1;
                $usuario->save();
                $idus=$usuario->id;
               if($request->sit==='1'){
                   $persona = new Persona();
                   $persona->idUser = $idus;
                   $persona->peTelefono = $request->telefo;

                   $persona->idDt = $request->iddis;
                   $persona->peNombres = $request->nombres;
                   $persona->peAPPaterno = $request->appaterno;
                   $persona->peAPMaterno = $request->apmaterno;
                   $persona->peNumeroDoc = $request->dni;
                   $persona->idTD = $request->tipdoc;
                   $persona->peDireccion = $request->dir;
                   $persona->peFecNac = date('Y-m-d', strtotime($request->fecnac));
                   $persona->peUsuReg = Auth::user()->id;
                   $persona->peFecActualiza = UtilController::fecha();
                   $persona->peUsuActuali = Auth::user()->id;
                   $persona->peFecCreacion = UtilController::fecha();
                   $persona->save();
                }else{
                   $persona = Persona::findOrFail($request->idpers);
                    $persona->idUser = $idus;
                    $persona->peFecActualiza = UtilController::fecha();
                    $persona->peUsuActuali = Auth::user()->id;
                    $persona->save();
                }
                $rol_usuario = new role_user();
                $rol_usuario->user_id = $idus;
                $rol_usuario->role_id = $request->rol;
                $rol_usuario->created_at = UtilController::fecha();
                $rol_usuario->updated_at = UtilController::fecha();
                $rol_usuario->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }

    }

    public function mostrarEditarUsuario($id)
    {
        try {
            $usuario = Usuario::mostrarUsuario($id);
            //dd($usuario);
            return view('intranet.Convenios.segurointegralsalud.datos.editarUsuario')->with('usuario', $usuario);
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }
    public function getEditUser($id)
    {
        try{
            $user= Usuario::mostrarUsuario($id);
            //dd($user);
            return response()->json(array('error' => 0, 'user' => $user));
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(),"UsuarioController","getEditUser");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function update(Request $request){
        try{
            DB::transaction(function () use ($request) {
                $usuario = User::findOrFail($request->iduser);
                $usuario->name = $request->nombre;
                $usuario->email = $request->correo;
                $usuario->password = bcrypt('ROOT');
                $usuario->updated_at = UtilController::fecha();
                $usuario->imagen = '/perfiles/user_default.png';
                $usuario->estado = 1;
                $usuario->save();

                $persona = Persona::findOrFail($request->idpers);
                $persona->idUser = $request->iduser;
                $persona->peTelefono = $request->telefo;

                $persona->idDt = $request->iddis;
                $persona->cPDId = null;

                $persona->peNombres = $request->nombres;
                $persona->peAPPaterno = $request->appaterno;
                $persona->peAPMaterno = $request->apmaterno;
                $persona->peNumeroDoc = $request->dni;
                $persona->idTD = $request->tipdoc;
                $persona->peDireccion = $request->dir;
                $persona->peFecNac = date('Y-m-d', strtotime($request->fecnac));
                $persona->peFecActualiza = UtilController::fecha();
                $persona->peUsuActuali = Auth::user()->id;
                $persona->save();

                $rol_usuario = role_user::findOrFail($request->idrolus);
                $rol_usuario->user_id = $request->iduser;
                $rol_usuario->role_id = $request->rol;
                $rol_usuario->updated_at = UtilController::fecha();
                $rol_usuario->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"UsuarioController","update");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function editarUsuario(Request $request)
    {
        try {
            $usuario = User::findOrFail($request->id);
            $usuario->name = $request->nombre;
            $usuario->email = $request->correo;
            $usuario->updated_at = UtilController::fecha();
            $usuario->estado = 1;
            $usuario->save();
            $rol_usuario = role_user::findOrFail($request->rolusid);
            $rol_usuario->user_id = $request->id;
            $rol_usuario->role_id = $request->rol;
            $rol_usuario->updated_at = UtilController::fecha();
            $rol_usuario->save();
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }

    }

    public function eliminar($id)
    {
        try {

            $usuario = User::findOrFail($id);
            if ($usuario->estado === 1)
                $estado = 0;
            else
                $estado = 1;

            Usuario::cambiarEstado($id, $estado);
            return response()->json(array('error' => 1));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function cargarPanel()
    {
        try {
            $usu = new User();
            $panel = $usu->cargarPanel(Auth::user()->id);
            return response()->json(array('error' => 0, 'panel' => $panel));
        } catch (Exception $e) {
            return response()->json(array('error' => 1, 'mensaje' => $e));
        }
    }

    public function validarUsuarioDni($dni)
    {
        try {
            $usu = new User();
            $cant = $usu->validarDniUsu($dni);
            return response()->json(array('error' => 0, 'cant' => $cant));
        } catch (Exception $e) {
            return response()->json(array('error' => 1, 'mensaje' => $e));
        }
    }


    public function obtenerPermisos($id)
    {
        try {
            return Datatables::of(Permiso::obtenerPermisos($id))->make(true);
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function cambiarPermiso($array)
    {
        try {

            $data = json_decode($array);

            if (empty($data->idpermiso)) {
                $per = new Permiso;
                $per->idSubMenu = $data->idsubmenu;
                $per->idUsuario = $data->idusu;
                $per->estado = 1;
                $per->usuCrea = Auth::user()->id;
                $per->usuModifica = Auth::user()->id;
                $per->fecModifica = UtilController::fecha();
                $per->fecCreacion = UtilController::fecha();
                $per->save();
            } else {
                if ($data->estado === 0)
                    Permiso::cambiarEstadoPermiso($data->idpermiso, 1);
                else
                    Permiso::cambiarEstadoPermiso($data->idpermiso, 0);
            }
            return response()->json(array('error' => 0, 'id' => $data->idusu));

        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }
    public function getUsuariotermino(Request $request)
    {
        $term = $request->input('term');
        return Usuario::obtenerUsuarioTermino($term);
    }
    function getUsuarioDni($dni)
    {

        try {
            $usuario= Usuario::getUsuarioDni($dni);
            $person = Persona::buscarPersonaDni($dni);
            //dd($person);
            return response()->json(array('error' => 0,'person'=>$person,'usuario'=>$usuario));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"Cliente","getClienteDni");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
