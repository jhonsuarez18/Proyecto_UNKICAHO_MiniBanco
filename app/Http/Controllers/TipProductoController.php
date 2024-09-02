<?php

namespace App\Http\Controllers;


use App\TipProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class TipProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getTipProducto()
    {
        return TipProducto::all();
    }
    public function index()
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
        try {
            DB::transaction(function () use ($request) {
                $tprod= New TipProducto();
                $tprod->tpDesc = $request->tipproducto;
                $tprod->idUm = $request->unidm;
                $tprod->tpFecCrea = UtilController::fecha();;
                $tprod->tpUsuReg = Auth::user()->id;
                $tprod->tpEst = 1;
                $tprod->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $tprod = TipProducto::findOrFail($request->idtipproducto);
                $tprod->tpDesc = $request->tipproducto;
                $tprod->idUm = $request->unidm;
                $tprod->tpFecActualiza = UtilController::fecha();;
                $tprod->tpUsuReg = Auth::user()->id;
                $tprod->tpEst = 1;
                $tprod->save();

            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($tpId)
    {
        try {
            DB::transaction(function () use ($tpId) {
                $tprod = TipProducto::findOrFail($tpId);
                ($tprod->tpEst === 1) ? $tprod->tpEst = 0 : $tprod->tpEst = 1;
                $tprod->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }
    public function obtenerTipProducto(){
        return datatables::of(TipProducto::obtenerTipProducto())->make(true);
    }
    public function obtenerTipProductoEditar($idtprod){
        $result = TipProducto::obtenerTipProductoEditar($idtprod);
        return response()->json(array('error' => 0, 'result' => $result));

    }
}
