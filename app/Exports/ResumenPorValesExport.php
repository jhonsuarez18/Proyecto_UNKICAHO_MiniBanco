<?php

namespace App\Exports;

use App\VConsumo;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ResumenPorValesExport implements FromView
{
    public function view(): View
    {
        return view('intranet.exports.combustible.reporteporvalesexport', [
            'vales' => VConsumo::reportegeneralval()
        ]);


    }

}
