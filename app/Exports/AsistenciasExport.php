<?php

namespace App\Exports;

use App\pacientecovid;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class AsistenciasExport implements FromView
{

    protected $fecha;

    function __construct($fecha) {
        $this->fecha = $fecha;
    }
    public function view(): View
    {
            return view('intranet.exports.asitenciasexport', [
                       'asistencias' => Pacientecovid::reportarAtencionesDiariasCovid($this->fecha)
             ]);


    }
}
