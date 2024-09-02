<?php

namespace App\Exports;

use App\EPPresupuesto;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResumenPorProgramaResolucionExport implements FromView
{
    public function view(): View
    {
        return view('intranet.exports.presupuesto.reporteporprogramaresolucionexport', [
            'ejecucion' => EPPresupuesto::obtenerReporteProgramaTransferencia()
        ]);


    }

}
