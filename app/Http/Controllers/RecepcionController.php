<?php

namespace App\Http\Controllers;

use App\Producto;
use App\recepcion;
use App\recepcion_producto;
use App\VentaProducto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class RecepcionController extends Controller
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
            return view('intranet.transacciones.recepcion')->with(array('vi' => $vi));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "RecepcionController", "index");
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
            $rc = New recepcion();
            $rc->idAl = $request->idalum;
            $rc->rcPrecioVal = $request->precval;
            $rc->rcCantVal = $request->cantval;
            $rc->rcFecCrea = UtilController::fecha();
            $rc->rcUsuReg = Auth::user()->id;
            $rc->rcEst = 1;
            $rc->save();
            for ($i = 0; $i < count($arrp); $i++) {
                $rcp = New recepcion_producto();
                $rcp->idRc = $rc->rcId;
                $rcp->idP = $arrp[$i];
                $rcp->rcpCant = $arrct[$i];
                $rcp->rcpPrecioV = $arrpv[$i];
                $rcp->rcpUsuReg = Auth::user()->id;
                $rcp->rcpFecCrea = UtilController::fecha();
                $rcp->rcpEst = 1;
                $rcp->save();
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
    public function destroy($est,$rcpId)
    {
        try {
            DB::transaction(function () use ($est,$rcpId) {
                $recep = recepcion_producto::findOrFail($rcpId);
                ($recep->rcpEst === 1) ? $recep->rcpEst = 0 : $recep->rcpEst = 1;
                $recep->save();
                $rcp=recepcion_producto::where('rcpId','=',$rcpId)->get();
                foreach ($rcp as $rcpt) {
                    $pd=Producto::where('pId','=',$rcpt->idP)->get();
                    foreach ($pd as $pdd) {
                        if($est==0){
                            $prod = Producto::findOrFail($rcpt->idP);
                            $prod->pStock=$pdd->pStock-$rcpt->vpCant;
                            $prod->save();
                        }else{
                            $prod = Producto::findOrFail($rcpt->idP);
                            $prod->pStock=$pdd->pStock+$rcpt->rcpCant;
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
    public function obtenerRecepcion(){
        return datatables::of(recepcion::obtenerRecepcion())->make(true);
    }
}
