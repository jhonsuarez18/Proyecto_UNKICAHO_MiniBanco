<?php

namespace App\Http\Controllers;

use App\EPDetallePedido;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class EPDetallePedidoController extends Controller
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

        try{

            DB::transaction(function () use ($request) {

                $edp = new EPDetallePedido();
                $edp->peId = $request->peId;
                $edp->ANO_EJE = $request->ANO_EJE;
                $edp->sec_ejec = $request->sec_ejec;
                $edp->TIPO_BIEN = $request->TIPO_BIEN;
                $edp->TIPO_PEDIDO = $request->TIPO_PEDIDO;
                $edp->SECUENCIA = $request->SECUENCIA;
                $edp->GRUPO_BIEN = $request->GRUPO_BIEN;
                $edp->CLASE_BIEN = $request->CLASE_BIEN;
                $edp->FAMILIA_BIEN = $request->FAMILIA_BIEN;
                $edp->ITEM_BIEN = $request->ITEM_BIEN;
                $edp->UNIDAD_MEDIDA = $request->UNIDAD_MEDIDA;
                $edp->CODIGO_ACTIVO = $request->CODIGO_ACTIVO;
                $edp->dPeUsuReg = 1;
                $edp->dPeEst = 1;
                $edp->created_at = UtilController::fecha();
                $edp->NRO_CUADRO = $request->NRO_CUADRO;
                $edp->CANT_SOLICITADA = $request->CANT_SOLICITADA;
                $edp->CANT_APROBADA = $request->CANT_APROBADA;
                $edp->CANT_ATENDIDA = $request->CANT_ATENDIDA;
                $edp->PRECIO_UNIT = $request->PRECIO_UNIT;
                $edp->VALOR_TOTAL = $request->VALOR_TOTAL;
                $edp->ESTADO_PED = $request->ESTADO_PED;
                $edp->ESTADO_ATEND = $request->ESTADO_ATEND;
                $edp->ESTADO_CONFOR = $request->ESTADO_CONFOR;
                $edp->FECHA_APROB = date('Y-m-d', strtotime($request->FECHA_APROB['date']));
                $edp->ESTADO_COMPRA = $request->ESTADO_COMPRA;
                $edp->ESTADO_PROG = $request->ESTADO_PROG;
                $edp->ITEM = mb_strtoupper($request->ITEM);
                $edp->save();
                return true;
            });
        } catch (\Exception $e) {
           // SErrorController::saveerror($e->getMessage(),"ReEstPacienteController","store");
           return response()->json(array('error' => $e->getMessage()));

        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    public function getItemsPedidos($idp)
    {
        return Datatables::of(EPDetallePedido::all()->where('peId','=',$idp))->make(true);

    }
}
