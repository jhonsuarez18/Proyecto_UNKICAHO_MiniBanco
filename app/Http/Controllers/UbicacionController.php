<?php

namespace App\Http\Controllers;

use App\establecimientooficina;
use App\UbicacionModel;
use Illuminate\Http\Request;
use vakata\database\Exception;

class UbicacionController extends Controller
{
    public function obtenerProvincia($iddep)
    {

        try {
            $result = UbicacionModel::obtenerProvincia($iddep);
            return response()->json(array('error' => 0, 'prov' => $result));

        } catch (Exception $e) {
            return response()->json(array('error' => $e));

        }
    }

    public function obtenerDistrito($prov)
    {

        try {
            $result = UbicacionModel::obtenerDistrito($prov);
            return response()->json(array('error' => 0, 'dis' => $result));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));

        }
    }

    public function obtenerDepartamentos()
    {
        try {
            $result = UbicacionModel::obtenerDepartamento();
            return response()->json(array('error' => 0, 'dep' => $result));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));

        }
    }

    public function obtenerEstablecimiento($iddis)
    {

            $result = UbicacionModel::obtenerEstablecimiento($iddis);
            return response()->json(array('error' => 0, 'eess' => $result));
    }

    public function getEstablecimientoFull(Request $request)
    {
        try {
            $term = $request->input('term');
            return UbicacionModel::getEstablecimientoFull($term);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), 'UbicacionController', 'getEstablecimientoFull');
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function obtenerCentroPoblado(Request $request)
    {
        $term = $request->input('term');
        return UbicacionModel::obtenerCentroPoblado($term);
    }

    public static function obtenerCentroPobladoNombre($name)
    {
        return $result = UbicacionModel::obtenerCentroPobladoNombre($name);
    }

    public function obtenerUbicacion($iddist)
    {
        try {
            $result = UbicacionModel::obtenerUbicacion($iddist);
            return response()->json(array('error' => 0, 'ubic' => $result));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerOficinas()
    {
        try {
            return $result = establecimientooficina::obtenerOficinas();
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerEjecutoras()
    {
        return UbicacionModel::obtenerEjecutora();
    }


}
