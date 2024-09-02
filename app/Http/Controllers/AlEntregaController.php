<?php

namespace App\Http\Controllers;

use App\ALEncargado;
use App\ALEntrega;
use App\ALEntregaStock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use ZipStream\Exception;

class AlEntregaController extends Controller
{

    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $entre = new ALEntrega();
                $entre->eMotivo = json_decode($request->motr);;
                $entre->eEnt = json_decode($request->enta);;
                $entre->eFecEntrega = date('Y-m-d', strtotime($request->fecen));
                $entre->eUsuReg = Auth::user()->id;
                $entre->idEess = $request->idEess;
                $entre->save();
                for ($i = 0; $i < count($request->idmovmat); $i++) {
                    $ent_stock = new ALEntregaStock();
                    $ent_stock->eId = $entre->eId;
                    $ent_stock->sId = $request->idmovmat[$i];
                    $ent_stock->esCantUni = $request->cantmovmat[$i];
                    $ent_stock->esEst = 1;
                    $ent_stock->esUsuReg = Auth::user()->id;;
                    $ent_stock->save();
                }
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "AlEntregaController", "store");
            return response(array('error' => $e->getMessage()));
        }
    }

    public function edit(Request $request){
        try {
            DB::transaction(function () use ($request) {
                $entre = ALEntrega::findOrFail($request->ident);
                $entre->eMotivo = json_decode($request->motr);;
                $entre->eEnt = json_decode($request->enta);;
                $entre->eFecEntrega = date('Y-m-d', strtotime($request->fecen));
                $entre->eUsuReg = Auth::user()->id;
                $entre->idEess = $request->idEess;
                $entre->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "AlEntregaController", "edit");
            return response(array('error' => $e->getMessage()));
        }
    }


    public function show($ide)
    {
        try {
            $ent=new ALEntrega();
            $result=$ent->showEntrega($ide);
            $ents=new ALEntregaStock();
            $mat=$ents->getStockMaterial($result->eId);
            return response()->json(array('error' => 0, 'mate' => $mat,'ent'=>$result));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "AlEntregaController", "show");
            return response(array('error' => $e->getMessage()));
        }
    }

    public function getEntrega()
    {
        try {
            $user = ALEncargado::where('idUsuario', Auth::user()->id)->first();
            $stock = new ALEntrega;
            return Datatables::of($stock->getEntrega($user->lId))->make(true);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "AlEntregaController", "getEntrega");
            return response(array('error' => $e->getMessage()));
        }
    }
    public function getItmsEntrega($eId)
    {
        try {
            $stock = new ALEntrega();
            return Datatables::of($stock->getItmsEntrega($eId))->make(true);
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","getItmsEntrega");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
