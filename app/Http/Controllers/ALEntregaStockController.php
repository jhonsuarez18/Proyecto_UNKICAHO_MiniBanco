<?php

namespace App\Http\Controllers;

use App\ALEntregaStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ALEntregaStockController extends Controller
{
    public function getEntSt($eId)
    {
        try {
            $ents = new ALEntregaStock();
            $mat = $ents->getStockMaterial($eId);
            return response()->json(array('error' => 0, 'mate' => $mat));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "AlEntregaController", "show");
            return response(array('error' => $e->getMessage()));
        }

    }

    public function edit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $ents = ALEntregaStock::findOrFail($request->idmat);
                $ents->esCantUni = $request->cant;
                $ents->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "AlEntregaController", "show");
            return response(array('error' => $e->getMessage()));
        }

    }

}
