<?php

namespace App;

use App\Http\Controllers\UtilController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Usuario extends Model
{
    protected $table = 'users';
    public $primaryKey = 'id';
    public $timestamps = false;
    public static function reportarUsuarios()
    {
        $query = DB::table('users as u')->select('u.id', DB::raw('concat(p.peAPPaterno," ",p.peAPMaterno," ",p.peNombres) as nombre'), 'u.name',
            'u.email', 'r.description', 'u.estado', 'u.imagen')
            ->join('persona as p', 'p.idUser', '=', 'u.id')
            ->join('role_user as ru', 'u.id', '=', 'ru.user_id')
            ->join('roles as r', 'r.id', '=', 'ru.role_id')
            ->get();
        return $query;
    }

    public static function obtenerRoles()
    {
        $query = DB::table('roles')->select('name as nombre', 'id')
            ->get();
        return $query;
    }

    public static function reportarUsuario($id)
    {
        $query = DB::table('users as u')->select('u.id', 'u.name', 'r.id as rolid', 'ru.id as rol_ud_id', 'u.imagen',
            'u.email', 'r.description', 'u.estado', 'u.created_at as creado', 'u.updated_at as actualizado')
            ->join('role_user as ru', 'u.id', '=', 'ru.user_id')
            ->join('roles as r', 'r.id', '=', 'ru.role_id')
            ->where('u.id', '=', $id)
            ->first();
        return $query;
    }


    public static function mostrarUsuario($id)
    {

        $query = DB::table('users as u')
            ->select('p.peNumeroDoc','p.idTD','p.peAPPaterno', 'p.peAPMaterno','p.peNombres',
                'p.peFecNac','p.peTelefono','p.peDireccion','u.email','u.name','u.id','ru.role_id','ru.id as idrolus',
                'p.peId', 'd.dtId as dist','pr.idProvincia as prov','pr.idDepartamento as depar')
            ->leftjoin('persona as p', 'u.id', '=', 'p.idUser')
            ->join('role_user as ru', 'u.id', '=', 'ru.user_id')
            ->join('roles as r', 'r.id', '=', 'ru.role_id')
            ->leftjoin('distrito as d', 'p.idDt', '=', 'd.dtId')
            ->leftjoin('provincia as pr', 'pr.idProvincia', '=', 'd.idProvincia')
            ->where('u.id', '=', $id)
            ->first();
        return $query;

    }
    public static function getUsuarioDni($dni)
    {

        $query = DB::table('users as u')
            ->select('p.peNumeroDoc','p.idTD','p.peAPPaterno', 'p.peAPMaterno','p.peNombres',
                'p.peFecNac','p.peTelefono','p.peDireccion','u.email','u.name','u.id','ru.role_id','ru.id as idrolus',
                'p.peId', 'd.dtId as dist','pr.idProvincia as prov','pr.idDepartamento')
            ->leftjoin('persona as p', 'u.id', '=', 'p.idUser')
            ->join('role_user as ru', 'u.id', '=', 'ru.user_id')
            ->join('roles as r', 'r.id', '=', 'ru.role_id')
            ->leftjoin('distrito as d', 'p.idDt', '=', 'd.dtId')
            ->leftjoin('provincia as pr', 'pr.idProvincia', '=', 'd.idProvincia')
            ->where('p.peNumeroDoc', '=', $dni)
            ->first();
        return $query;

    }
    public static function cambiarEstado($id, $estado)
    {
        return $result = DB::table('users')
            ->where(['id' => $id])
            ->update(['estado' => $estado, 'updated_at' => UtilController::fecha()]);

    }

    public function cargarPanel($idUsuario)
    {
        $query = DB::table('menu as m')
            ->select('m.idMenu as midMenu', 'm.titulo as mtitulo',
                'm.descripcion as mdescripcion',
                'm.color as mcolor', 'm.img as mimg', 's.idSubMenu as sidSubMenu', 's.subTitulo as ssubTitulo'
                , 's.url')->
            rightJoin('submenu as s', 'm.idMenu', '=', 's.idMenu')->
            rightJoin('permiso as p', 'p.idSubmenu', '=', 's.idSubmenu')
            ->where('p.idUsuario', '=', $idUsuario)
            ->where('s.estado', '=', 1)
            ->where('m.estado', '=', 1)
            ->where('p.estado', '=', 1)
            ->get();
        return $query;
    }
    static function obtenerUsuarioTermino($term){
        $query = DB::table('users as u')
            ->select('u.id as idu', 'u.name as usname', DB::raw('concat(p.numeroDoc," || ",p.apPaterno," ",p.apMaterno,", ",p.pNombre," ",ifnull(p.sNombre,"")) as nombre'),'p.numeroDoc','u.estado')
            ->join('persona as p', 'u.id', '=', 'p.idUser')
            ->Where(DB::raw('concat(p.numeroDoc,"||",p.apPaterno," ",p.apMaterno,", ",p.pNombre," ",ifnull(p.sNombre,""))'), 'LIKE', "%$term%")
            ->where('u.estado','=',1)
            ->limit(10000)
            ->get();
        return $query;
    }
}
