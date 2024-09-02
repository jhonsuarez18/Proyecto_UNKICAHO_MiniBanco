<?php

namespace App\Http\Controllers;

use App\ViGasto;
use App\ViViatico;
use App\reReferencia;
use Illuminate\Http\Request;
use vakata\database\Exception;

class ViViaticoController extends Controller
{

    public function index($id)
    {
        try {
            $viaticos = array();
            $viatico = new ViViatico();
            $vi = $viatico->getViaitcoId($id);
            $ref = new reReferencia();
            $referencia = $ref->getDiasRef($vi->rId);
            $gastos = ViGasto::whereIn('gId', [1, 2])->get();
            for ($i = 0; $i < count($gastos); $i++) {
                switch ($gastos[$i]["gId"]) {
                    case 1:
                        $viaticos['alim'] = $gastos[$i]["gCosDia"] * $referencia->dias;
                        break;
                    case 2:
                        $viaticos['hosp'] = $gastos[$i]["gCosDia"] * ($referencia->dias - 1);
                        break;
                }
            }
       //dd(array('vi' => $vi, 'calcvia' => $viaticos));
        return view('intranet.rendicion.viatico.detallaviatico')->with(array('vi' => $vi, 'calcvia' => $viaticos));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ViViaticoController", "index");
            return response(array('error' => $e->getMessage()));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\ViViatico $viViatico
     * @return \Illuminate\Http\Response
     */
    public function show(ViViatico $viViatico)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ViViatico $viViatico
     * @return \Illuminate\Http\Response
     */
    public function edit(ViViatico $viViatico)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ViViatico $viViatico
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ViViatico $viViatico)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ViViatico $viViatico
     * @return \Illuminate\Http\Response
     */
    public function destroy(ViViatico $viViatico)
    {
        //
    }
}
