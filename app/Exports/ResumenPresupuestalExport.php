<?php

namespace App\Exports;

use App\EPPresupuesto;
use Maatwebsite\Excel\Concerns\FromCollection;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResumenPresupuestalExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    public function view(): View
    {
        return view('intranet.exports.presupuesto.reportegeneralexport', [
            'ejecucion' => EPPresupuesto::reporteEjeucion()
        ]);
    //dd(EPPresupuesto::reporteEjeucion());

    }
}
