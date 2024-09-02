<?php

namespace App\Http\Controllers;

use App\ALEncargado;
use App\ALLocal;
use App\permiso;
use App\SubMenu;
use App\UbicacionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class EncargadoController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::transaction(function () use ($request) {
                $encarg=New ALEncargado();

                $encarg->lId=$request->idlocal;
                $encarg->idUsuario=$request->iduser;
                $encarg->enFecCrea = UtilController::fecha();
                $encarg->enUsuReg = Auth::user()->id;
                $encarg->save();
                if (!empty($request->listidspermisalm)) {
                    foreach ($request->listidspermisalm as $lista) {
                        $per = new Permiso;
                        $per->idSubMenu = $lista;
                        $per->idUsuario = $request->iduser;
                        $per->estado = 1;
                        $per->usuCrea = Auth::user()->id;
                        $per->usuModifica = Auth::user()->id;
                        $per->fecModifica = UtilController::fecha();
                        $per->fecCreacion = UtilController::fecha();
                        $per->save();
                    }
                }
            });

            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"EncargadoController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            DB::transaction(function() use($request){
                $encarg=ALEncargado::findOrfail($request->idencarg);
                $encarg->lId=$request->idlocaledit;
                $encarg->idUsuario=$request->iduseredit;
                $encarg->enFecCrea = UtilController::fecha();
                $encarg->enUsuReg = Auth::user()->id;
                $encarg->save();

            });

            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"EncargadoController","edit");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //AGREGADO 01-12-2020
        try {
            DB::transaction(function () use ($id) {
                $encarg = ALEncargado::findOrFail($id);
                ($encarg->enEst === 1) ? $encarg->enEst = 0 : $encarg->enEst = 1;
                $encarg->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"EncargadoController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function delete(Request $request)
    {
        //AGREGADO 07-12-2020
        try {
            DB::transaction(function () use ($request) {
                $encarg = ALEncargado::findOrFail($request->idencarg);
                ($encarg->enEst === 1) ? $encarg->enEst = 0 : $encarg->enEst = 1;
                $encarg->save();
                foreach ($request->listidspermisalm as $lista)
                {
                    $perm = permiso::findOrFail($lista);
                    $perm->estado = 0;
                    $perm->save();
                }
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"EncargadoController","delete");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function obtenerEjecutora()
    {
        return UbicacionModel::obtenerEjecutora();
    }
    public function getencargados()
    {
            return Datatables::of(ALEncargado::getEncargados())->make(true);

    }
    public static function getEncargadoEdit($id)
    {
        try{
            $result= DB::table('a_l_encargado as en')
                ->select('en.enId','en.lId','en.idUsuario','l.lNombre','e.idEjecutora','e.codigoEjecutora','e.descripcionEjecutora as ejecutora','p.numeroDoc as dni',DB::raw('concat(p.numeroDoc," || ",p.apPaterno," ",p.apMaterno,", ",p.pNombre," ",ifnull(p.sNombre,"")) as nombre'),'u.name as user','en.enEst')
                ->join('a_l_local as l', 'en.lId', '=', 'l.lId')
                ->join('users as u', 'en.idUsuario', '=', 'u.id')
                ->join('ejecutora as e', 'l.idEjecutora', '=', 'e.idEjecutora')
                ->join('persona as p', 'u.id', '=', 'p.idUser')
                ->where('en.enId','=',$id)
                ->get();
            return response()->json(array('error' => 0, 'result' => $result));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"EncargadoController","obtenerEncargadoEdit");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getlocal($ideje){
        $loc=ALLocal::where(['idEjecutora'=>$ideje])->where(['lEst'=>1])->select('lId','idEjecutora','lNombre')->get();
        return response()->json(array('error'=>0,'loc'=>$loc));
    }
    public function ValidarUsuario($id){
        $Usua = ALEncargado::where(['idUsuario' => $id])->where(['enEst'=>1])->select('idUsuario','enEst')->get();
        return response()->json(array('error' => 0, 'usu' => $Usua));

    }
    public function ValidarUsuarioL($idu){
        $Usua = ALEncargado::where(['idUsuario' => $idu])->select('lId','idUsuario','enEst')->get();
        return response()->json(array('error' => 0, 'usu' => $Usua));

    }
    public function getPermisos($id){
        try {

            $result =SubMenu::where('idMenu',4)->where('estado',1)->orderby('idSubMenu','DESC')->get();
            $encarg= DB::table('permiso as p')
                ->select('p.idPermiso','p.idSubMenu','sm.subTitulo','p.idUsuario','p.estado')
                ->join('submenu as sm', 'p.idSubMenu', '=', 'sm.idSubMenu')
                ->join('menu as m', 'sm.idMenu', '=', 'm.idMenu')
                ->join('users as u', 'p.idUsuario', '=', 'u.id')
                ->where('p.idUsuario','=',$id)
                ->where('sm.idMenu','=',4)
                ->get();
            return response()->json(array('error' => 0, 'result' => $result,'encarg'=>$encarg));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"EncargadoController","getPermisos");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
