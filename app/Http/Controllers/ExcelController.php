<?php

namespace App\Http\Controllers;

use App\Exports\AsistenciasExport;
use App\Exports\EjecutoraExport;
use App\Exports\ResumenPorEspecificaExport;
use App\Exports\ResumenPorProgramaEspecificaExport;
use App\Exports\ResumenPorProgramaExport;
use App\Exports\ResumenPorProgramaResolucionExport;
use App\Exports\ResumenPorValesExport;
use App\Exports\ResumenPresupuestalExport;
use App\Exports\ResumenTransferenciaExport;
use App\Exports\ResumenPorCeplanExport;
use App\Exports\ResumenPorTramaExport;
use App\Exports\ResumenPorPedidoExport;
use App\Http\Controllers\UtilController;
use Maatwebsite\Excel\Facades\Excel;
use vakata\database\Exception;
class ExcelController extends Controller

{
    public function indicadoresExcel($codejecutora, $tiporeporte)
    {
        try {
            return Excel::download(new EjecutoraExport($codejecutora),
                'DASCS_INDI_SIS_POR_EJECUTORA-'.UtilController::fecha().'.xlsx');
        } catch (Exception $e) {
            return $e;
        }
    }

    public function imprimirAsistenciasDiarias($array)
    {
        try {

           if ($array === '0') {
            $fecha = 'now()';
               return Excel::download(new AsistenciasExport($fecha),
                   'asistencia.xlsx');
            } else {
                $data = json_decode($array);
               $fecha = date('Y-m-d', strtotime($data->fecbus));
                return Excel::download(new AsistenciasExport('"' . $fecha . '"'),
                    'asistencia-'.UtilController::fecha().'.xlsx');
          }
        } catch (Exception $e) {
            return $e;
        }
    }
    public function obtenerResumenPresupuestalExport()
    {
        try {

                return Excel::download(new ResumenPresupuestalExport(),
                    'resumenpresupuestalgeneral-'.UtilController::fecha().'.xlsx');

        } catch (Exception $e) {
            return $e;
        }
    }

    public function obtenerReportePresupuestalTransferenciaExport()
    {
        try {

            return Excel::download(new ResumenTransferenciaExport(),
                'resumentransferencia-'.UtilController::fecha().'.xlsx');

        } catch (Exception $e) {
            return $e;
        }
    }
    public function obtenerReportePresupuestalProgramaExport()
    {
        try {

            return Excel::download(new ResumenPorProgramaExport(),
                'resumenporprograma-'.UtilController::fecha().'.xlsx');

        } catch (Exception $e) {
            return $e;
        }
    }
    public function obtenerReportePresupuestalProgramaTransferenciaExport()
    {
        try {

            return Excel::download(new ResumenPorProgramaResolucionExport(),
                'resumenporprogramaresolucion-'.UtilController::fecha().'.xlsx');

        } catch (Exception $e) {
            return $e;
        }
    }
    public function obtenerResumenPorProgramaEspecificaExport()
    {
        try {

            return Excel::download(new ResumenPorProgramaEspecificaExport(),
                'resumenporprogramaresolucionespecifica-'.UtilController::fecha().'.xlsx');

        } catch (Exception $e) {
            return $e;
        }
    }
    public function obtenerResumenPorEspecGas()
    {
        try {

            return Excel::download(new ResumenPorEspecificaExport(),
                'resumenporespecificagasto-'.UtilController::fecha().'.xlsx');

        } catch (Exception $e) {
            return $e;
        }
    }
    public function obtenerResumenPresupuestalCeplanExport()
    {
        try {

            return Excel::download(new ResumenPorCeplanExport(),
                'resumenporceplan-'.UtilController::fecha().'.xlsx');

        } catch (Exception $e) {
            return $e;
        }
    }
    public function obtenerResumenPresupuestalTramaExport()
    {
        try {

            return Excel::download(new ResumenPorTramaExport(),
                'resumenportrama-'.UtilController::fecha().'.xlsx');

        } catch (Exception $e) {
            return $e;
        }
    }
    public function obtenerResumenPresupuestalPedidoExport()
    {
        try {

            return Excel::download(new ResumenPorPedidoExport(),
                'resumenporpedido-'.UtilController::fecha().'.xlsx');

        } catch (Exception $e) {
            return $e;
        }
    }
    public function obtenerResumenValesExport()
    {
        try {

            return Excel::download(new ResumenPorValesExport(),
                'resumenporvales-'.UtilController::fecha().'.xlsx');

        } catch (Exception $e) {
            return $e;
        }
    }
    public function subirExcel()
    {
        try {
            echo 'aqui';
        } catch (Exception $e) {
            return $e;
        }
    }

    public function index()
    {
        try {
            return view('intranet.Convenios.segurointegralsalud.excel.excel');
        } catch (Exception $e) {
            return $e;
        }
    }
}
