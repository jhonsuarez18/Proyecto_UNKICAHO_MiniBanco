<?php

namespace App\Http\Controllers;


use Faker\Provider\DateTime;
use NumberFormatter;

class UtilController extends Controller
{
    static function fecha()
    {
        date_default_timezone_set('America/Lima');
        $fecha = date('Y-m-d H:i:s');
        return $fecha;
    }

    static function fecha_ingles()
    {
        date_default_timezone_set('America/Lima');
        $fecha = date('Y-m-d H:i:s');
        return $fecha;
    }

    static function fecha_a_ingles($fecha)
    {
        $fecha = date("Y-m-d", strtotime($fecha));
        return $fecha;
    }

    static function fecha_a_espanol($fecha)
    {
        $fecha = date("d-m-Y", strtotime($fecha));
        return $fecha;
    }

    function basico($numero)
    {
        $valor = array('uno', 'dos', 'tres', 'cuatro', 'cinco', 'seis', 'siete', 'ocho',
            'nueve', 'diez', 'once','doce','trece','catorce','quince','diesyseis','diesysiete','diesyocho',
            'diesynuevo','veinte', 'veinticuatro', 'veinticinco',
            'veintiséis', 'veintisiete', 'veintiocho', 'veintinueve');
        return $valor[$numero - 1];
    }

    function decenas($n)
    {
        $decenas = array(30 => 'treinta', 40 => 'cuarenta', 50 => 'cincuenta', 60 => 'sesenta',
            70 => 'setenta', 80 => 'ochenta', 90 => 'noventa');
        if ($n <= 29) return  $this->basico($n);
        $x = $n % 10;
        if ($x == 0) {
            return $decenas[$n];
        } else return $decenas[$n - $x] . ' y ' . $this->basico($x);
    }

    function centenas($n)
    {
        $cientos = array(100 => 'cien', 200 => 'doscientos', 300 => 'trecientos',
            400 => 'cuatrocientos', 500 => 'quinientos', 600 => 'seiscientos',
            700 => 'setecientos', 800 => 'ochocientos', 900 => 'novecientos');
        if ($n >= 100) {
            if ($n % 100 == 0) {
                return $cientos[$n];
            } else {
                $u = (int)substr($n, 0, 1);
                $d = (int)substr($n, 1, 2);
                return (($u == 1) ? 'ciento' : $cientos[$u * 100]) . ' ' .  $this->decenas($d);
            }
        } else return  $this->decenas($n);
    }

    function miles($n)
    {
        if ($n > 999) {
            if ($n == 1000) {
                return 'mil';
            } else {
                $l = strlen($n);
                $c = (int)substr($n, 0, $l - 3);
                $x = (int)substr($n, -3);
                if ($c == 1) {
                    $cadena = 'mil ' .  $this->centenas($x);
                } else if ($x != 0) {
                    $cadena =  $this->centenas($c) . ' mil ' .  $this->centenas($x);
                } else $cadena =  $this->centenas($c) . ' mil';
                return $cadena;
            }
        } else return  $this->centenas($n);
    }

    function millones($n)
    {
        if ($n == 1000000) {
            return 'un millón';
        } else {
            $l = strlen($n);
            $c = (int)substr($n, 0, $l - 6);
            $x = (int)substr($n, -6);
            if ($c == 1) {
                $cadena = ' millón ';
            } else {
                $cadena = ' millones ';
            }
            return  $this->miles($c) . $cadena . (($x > 0) ?  $this->miles($x) : '');
        }
    }

     function convertirNumero($n)
    {
        switch (true) {
            case ($n >= 1 && $n <= 29) :
                return  $this->basico($n);
                break;
            case ($n >= 30 && $n < 100) :
                return  $this->decenas($n);
                break;
            case ($n >= 100 && $n < 1000) :
                return  $this->centenas($n);
                break;
            case ($n >= 1000 && $n <= 999999):
                return  $this->miles($n);
                break;
            case ($n >= 1000000):
                return  $this->millones($n);
        }
    }


    function convertirMesNumLet($mes){
        $meses = ["Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto",
            "Septiembre", "Octubre", "Noviembre", "Diciembre"];
        if ($mes <= 12) {
            return $meses[$mes - 1];
        }
        else{
            return "Solo existen 12 meses hay un error en el formato de tu fecha: ".$mes;
        }
    }

}
