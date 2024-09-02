<?php

namespace App\Http\Controllers;
use App\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vi = 1;
            return view('intranet.mantenimiento.agregarproducto')->with(array('vi' => $vi));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ProductoController", "index");
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
        try {
            //dd($request);
            DB::transaction(function () use ($request) {
                $prod= New Producto();
                $prod->idTp = $request->tipproducto;
                $prod->idM = $request->marca;
                $prod->idPs = $request->presenta;
                $prod->pContenido = $request->contenido;
                $prod->pPrecioC = $request->precioc;
                $prod->pPrecioV = $request->preciov;
                $prod->pStock = $request->stock;
                $prod->pFecCrea = UtilController::fecha();;
                $prod->pUsuReg = Auth::user()->id;
                $prod->pEst = 1;
                $prod->save();
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
    public function edit($idtipprod)
    {

        try {
            $ve = new Producto();
            return $ve->obtenerProductoEditar($idtipprod);
        } catch (\Exception $e) {
            return response()->json(array('error' => $e->getMessage()));
        }
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
                $prod = Producto::findOrFail($request->idproducto);
                $prod->idTp = $request->tipproducto;
                $prod->idM = $request->marca;
                $prod->idPs = $request->presenta;
                $prod->pContenido = $request->contenido;
                $prod->pPrecioC = $request->precioc;
                $prod->pPrecioV = $request->preciov;
                $prod->pStock = $request->stock;
                $prod->pFecCrea = UtilController::fecha();;
                $prod->pUsuReg = Auth::user()->id;
                $prod->pEst = 1;
                $prod->save();

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
    public function destroy($pId)
    {
        try {
            DB::transaction(function () use ($pId) {
                $prod = Producto::findOrFail($pId);
                ($prod->pEst === 1) ? $prod->pEst = 0 : $prod->pEst = 1;
                $prod->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }
    public function obtenerProducto(){
        return datatables::of(Producto::obtenerProducto())->make(true);
    }
    public function obtenerProductoEditar($idprod){
        $result = Producto::obtenerProductoEditar($idprod);
        return response()->json(array('error' => 0, 'result' => $result));

    }
    public function getProducto(){
        $result = Producto::getProductoAct();
        return response()->json(array('error' => 0, 'result' => $result));
    }
}
