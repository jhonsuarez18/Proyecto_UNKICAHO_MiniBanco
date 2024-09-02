<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\DB;


class User extends Authenticatable
{
    use Notifiable;
    protected $fillable = [
        'name', 'email', 'password', 'rol'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    public function authorizeRoles($roles)
    {
        abort_unless($this->hasAnyRole($roles), 401);
        return true;
    }

    public function hasAnyRole($roles)
    {
        // Session::put('rol', $roles);
        if (is_array($roles)) {
            foreach ($roles as $role) {
                if ($this->hasRole($role)) {
                    return true;
                }
            }
        } else {
            if ($this->hasRole($roles)) {
                return true;
            }
        }
        return false;
    }

    public function hasRole($role)
    {
        if ($this->roles()->where('name', $role)->first()) {
            return true;
        }
        return false;
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

    public function validarDniUsu($dni)
    {
        $query = DB::table('users as u')
            ->select(DB::raw('count(*) as cant'))->
            join('persona as p', 'p.idUser', '=', 'u.id')
            ->where('p.peNumeroDoc', '=', $dni)
            ->get();
        return $query;
    }




}
