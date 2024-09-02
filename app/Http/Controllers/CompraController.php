<?php

namespace App\Http\Controllers;

use App\Compra;
use App\CompraProducto;
use App\Marca;
use App\Producto;
use App\VCOcTCombust;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vi=1;
            return view('intranet.transacciones.compra')->with(array('vi' => $vi));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "CompraController", "index");
            return response(array('error' => $e->getMessage()));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        DB::transaction(function () use ($request) {
            $arrct = json_decode($request->arrct);
            $arrp = json_decode($request->arrp);
            $arrpc = json_decode($request->arrpc);
            $compr = New Compra();
            $compr->idPv = $request->proveed;
            $compr->cNFactura = $request->nfactura;
            $compr->cIgv = $request->igv;
            $compr->cFecCrea = UtilController::fecha();
            $compr->cUsuReg = Auth::user()->id;
            $compr->cEst = 1;
            $compr->save();
            for ($i = 0; $i < count($arrp); $i++) {
                $compp = New CompraProducto();
                $compp->idC = $compr->cId;
                $compp->idP = $arrp[$i];
                $compp->cpCant = $arrct[$i];
                $compp->cpPrecioC = $arrpc[$i];
                $compp->cpUsuReg = Auth::user()->id;
                $compr->cpFecCrea = UtilController::fecha();
                $compp->cpEst = 1;
                $compp->save();
                $pd=Producto::where('pId','=',$arrp[$i])->get();
                foreach ($pd as $pp) {
                    $prod = Producto::findOrFail($pp->pId);
                    $prod->pStock = $pp->pStock+$arrct[$i];
                    $prod->save();
                    //dd($pp->pStock);
                }

            }

        });
        return response()->json(array('error' => 0));
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
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($est,$cpId)
    {
        try {
            DB::transaction(function () use ($est,$cpId) {
                $comp = CompraProducto::findOrFail($cpId);
                ($comp->cpEst === 1) ? $comp->cpEst = 0 : $comp->cpEst = 1;
                $comp->save();
                $cp=CompraProducto::where('cpId','=',$cpId)->get();
                foreach ($cp as $cpt) {
                    $pd=Producto::where('pId','=',$cpt->idP)->get();
                    foreach ($pd as $pdd) {
                        if($est==0){
                            $prod = Producto::findOrFail($cpt->idP);
                            $prod->pStock=$pdd->pStock+$cpt->cpCant;
                            $prod->save();
                        }else{
                            $prod = Producto::findOrFail($cpt->idP);
                            $prod->pStock=$pdd->pStock-$cpt->cpCant;
                            $prod->save();
                        }
                    }
                }
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }
    public function obtenerCompra(){
        return datatables::of(Compra::obtenerCompra())->make(true);
    }
}
