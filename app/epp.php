<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class epp extends Model
{
    protected $table = 'epp';
    public $primaryKey = 'idEpp';
    public $timestamps = false;

    public static function obtenerEpps($idPac)
    {
        DB::select('DROP TABLE IF EXISTS  tempTable1');
        DB::select('CREATE TEMPORARY TABLE tempTable1
            SELECT p.idEpp,max(p.descripcion) descripcion,ep.Cantidad,max(ep.idEntregaEpp) idEntregaEpp FROM epp p
            join entregaepp ep on ep.idEpp=p.idEpp
            where p.estado=1 and ep.estado=1
            group by p.idEpp,ep.Cantidad;');

        return DB::select('select * from tempTable1 where
        idEntregaEpp not in(
                    select idEntregaEpp from entregaepppaciente
        where idPacienteCovid='.$idPac.')');


    }
    public static function obtenerEppsUni($idPac)
    {
        DB::select('DROP TABLE IF EXISTS  tempTable1');
        DB::select('CREATE TEMPORARY TABLE tempTable1
            SELECT case when p.idEpp=1 or p.idEpp=2 then 6
                   when p.idEpp!=1 or p.idEpp!=2 then p.idEpp end eppid,
                   case when p.idEpp=1 or p.idEpp=2 then "MASCARILLA"
                   when p.idEpp!=1 or p.idEpp!=2 then max(p.descripcion)  end descripcion,
                   max(ep.idEntregaEpp) idEntregaEpp FROM epp p
            join entregaepp ep on ep.idEpp=p.idEpp
            where p.estado=1
            group by p.idEpp;');

        return DB::select('select * from tempTable1 where
        idEntregaEpp not in(
                    select idEntregaEpp from entregaepppaciente
        where idPacienteCovid='.$idPac.')');


    }
}
