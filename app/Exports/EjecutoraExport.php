<?php

namespace App\Exports;


use App\Role;
use Maatwebsite\Excel\Concerns\FromCollection;

class EjecutoraExport  implements FromCollection
{

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Role::all();
    }

}

