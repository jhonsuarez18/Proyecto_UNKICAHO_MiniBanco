<?php

namespace App\Exports;

use App\EPPresupuesto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResumenPorProgramaEspecificaExport implements FromView
{
    public function view(): View
    {
        return view('intranet.exports.presupuesto.reporteporprogramaespecificaexport', [
            'ejecucion' => EPPresupuesto::obtenerReporteFinalidad()
        ]);


    }
}
