<?php

namespace App\Http\Controllers;
use App\EPPedido;
use App\EPCentroCosto;
use App\UtilController;
use App\SErrorController;

use Illuminate\Http\Request;

class EpPedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $centcos = EPCentroCosto::where(['cCCentroCosto' => $request->CENTRO_COSTO, 'cCAnoEje' => 2021])->first();
            $epp = EPPedido::findOrFail($request->peId);
            $epp->cCId = $centcos->cCId;
            $epp->peDesc = mb_strtoupper($request->MOTIVO_PEDIDO);;
            $epp->peFecPre = date('Y-m-d', strtotime($request->FECHA_PEDIDO['date']));;
            $epp->save();
            return true;
        } catch (\Exception $e) {
           // SErrorController::saveerror($e->getMessage(), "EpPedidoController", "update");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getPedidoItemsBS()
    {
       // return $pedidos = EPPedido::all();
        return $pedidos = EPPedido::whereIn('tId', [1,2])->get();
    }


    public function updatePedidoSinMonto($codped, $monto)
    {
        try {
            $pedido = EPPedido::findOrfail($codped);
            $pedido->peMonto = $monto;
            $pedido->pefecActMont = UtilController::fecha();
            $pedido->save();
            return true;
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "EpPedidoController", "updatePedidoSinMonto");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    //primera Actualizacion de monto de los pedidos registrados con 0
    public function actMontPed(){
        try{
           $ep= new EPPedido();
           $ep->actMontPed();
           return  true;
        } catch (\Exception $e) {
          //  SErrorController::saveerror($e->getMessage(), "EpPedidoController", "actMontPed");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
