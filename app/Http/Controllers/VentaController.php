<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\ApiEPDetallePedidoController;
use App\Producto;
use App\Venta;
use App\VentaProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;
use GuzzleHttp\Client;

class VentaController extends Controller
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
            return view('intranet.transacciones.venta')->with(array('vi' => $vi));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VentaController", "index");
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
            //dd($request);
            $arrct = json_decode($request->arrct);
            $arrp = json_decode($request->arrp);
            $arrpv = json_decode($request->arrpv);
            $venta = New Venta();
            $venta->idCl = $request->idcli;
            $venta->vPrecioVal = $request->precval;
            $venta->vCantVal = $request->cantval;
            $venta->vFecCrea = UtilController::fecha();
            $venta->vUsuReg = Auth::user()->id;
            $venta->vEst = 1;
            $venta->save();
            for ($i = 0; $i < count($arrp); $i++) {
                $ventap = New VentaProducto();
                $ventap->idV = $venta->vId;
                $ventap->idP = $arrp[$i];
                $ventap->vpCant = $arrct[$i];
                $ventap->vpPrecioV = $arrpv[$i];
                $ventap->vpUsuReg = Auth::user()->id;
                $ventap->vpFecCrea = UtilController::fecha();
                $ventap->vpEst = 1;
                $ventap->save();
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
    public function destroy($est,$vpId)
    {
        try {
            DB::transaction(function () use ($est,$vpId) {
                $vent = VentaProducto::findOrFail($vpId);
                ($vent->vpEst === 1) ? $vent->vpEst = 0 : $vent->vpEst = 1;
                $vent->save();
                $vp=VentaProducto::where('vpId','=',$vpId)->get();
                foreach ($vp as $vpt) {
                    $pd=Producto::where('pId','=',$vpt->idP)->get();
                    foreach ($pd as $pdd) {
                        if($est==0){
                            $prod = Producto::findOrFail($vpt->idP);
                            $prod->pStock=$pdd->pStock-$vpt->vpCant;
                            $prod->save();
                        }else{
                            $prod = Producto::findOrFail($vpt->idP);
                            $prod->pStock=$pdd->pStock+$vpt->vpCant;
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
    public function obtenerVenta(){
        return datatables::of(Venta::obtenerVenta())->make(true);
    }
}
