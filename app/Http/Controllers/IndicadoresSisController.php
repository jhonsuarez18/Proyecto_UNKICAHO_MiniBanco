<?php

namespace App\Http\Controllers;

use App\IndicadorSisModel;
use Illuminate\Http\Request;
use vakata\database\Exception;

class IndicadoresSisController extends Controller
{
    public function notas()
    {
        try {
             $indicadoresActRow = IndicadorSisModel::indicadoresMesActual();
             $indicadoresPasRow = IndicadorSisModel::indicadoresMesAnterior();

            if (empty($indicadoresPasRow))
                $indicadoresPasRow = null;

            return response()->json(array('error' => 0, 'indicadoresAct' => $indicadoresActRow,
                'indicadoresPas' => $indicadoresPasRow));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function verInfoIndicadores($idIndicador)
    {
        try {
            $infIndicador = IndicadorSisModel::obtenerInformacionIndicador($idIndicador);
            return response()->json(array('error' => 0, 'infoIndicador' => $infIndicador));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }


    public function obtenerDona($nroIndicador)
    {
        try {
            $infIndicador = IndicadorSisModel::donaIndicador($nroIndicador);
            return response()->json(array('error' => 0, 'infoIndicador' => $infIndicador));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerDonaRegional($nroIndicador)
    {
        try {
            $infIndicador = IndicadorSisModel::indicadorRegional($nroIndicador);
            return response()->json(array('error' => 0, 'infoIndicador' => $infIndicador));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerGraficoRegional($nroIndicador, $codEjecutora)
    {
        try {
            $infIndicador = IndicadorSisModel::llenarGrafico($nroIndicador, $codEjecutora);
            return response()->json(array('error' => 0, 'infoIndicador' => $infIndicador));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerReporteMesesIndicador($codigo)
    {
        try {
            $indicador = IndicadorSisModel::porcentajePorMeses($codigo);
            return response()->json(array('error' => 0, 'infoIndicador' => $indicador));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerReporteeEjecuMetaLogro($Mes, $cod)
    {
        try {
            $indicador = IndicadorSisModel::cantEjecuMesMetaLog($Mes, $cod);
            return response()->json(array('error' => 0, 'infoIndicador' => $indicador));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerIndicadorEjecutora($ejecutora, $codigo)
    {
        try {
            $indicador = IndicadorSisModel::ejecutoraDesempeñoMeses($ejecutora, $codigo);
            return response()->json(array('error' => 0, 'infoIndicador' => $indicador));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerComentarios($codindi, $fecha)
    {
        try {
            $comentario = IndicadorSisModel::comentarios($codindi, $fecha
            );
            return response()->json(array('error' => 0, 'comentarios' => $comentario));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function modificarComentario(Request $request)
    {
        try {

            $result = IndicadorSisModel::modificarComentario($request->idgrafico, $request->idindi, $request->comentario, $request->fecha);
            return response()->json(array('error' => 0));

        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function obtenerRespuesta($codindi, $fecha)
    {
        try {
            $respuesta = IndicadorSisModel::obtenerRespuestas($codindi, $fecha);
            return response()->json(array('error' => 0, 'respuestas' => $respuesta));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }

    }

    public function ingresarRepuesta(Request $request)
    {
        try {
            $respuesta = IndicadorSisModel::insertarRespuesta($request->cod_indi,$request->fecha,$request->respuesta);
            return response()->json(array('error' => 0, 'respuestas' => $respuesta));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }



}
