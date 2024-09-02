<?php

namespace App\Http\Controllers;

use App\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ProveedorController extends Controller
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
            return view('intranet.mantenimiento.agregarproveedor')->with(array('vi' => $vi));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ProveedorController", "index");
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
            DB::transaction(function () use ($request) {
                $prov= New Proveedor();
                $prov->idDt = $request->distrito;
                $prov->pvRuc = $request->ruc;
                $prov->pvRazonS = $request->razons;
                $prov->pvTelefono = $request->telefono;
                $prov->pvDireccion = $request->direccion;
                $prov->pvFecCrea = UtilController::fecha();;
                $prov->pvUsuReg = Auth::user()->id;
                $prov->pvEst = 1;
                $prov->save();
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
                $prov = Proveedor::findOrFail($request->idprov);
                $prov->idDt = $request->distrito;
                $prov->pvRuc = $request->ruc;
                $prov->pvRazonS = $request->razons;
                $prov->pvTelefono = $request->telefono;
                $prov->pvDireccion = $request->direccion;
                $prov->pvFecActualiza = UtilController::fecha();;
                $prov->pvUsuReg = Auth::user()->id;
                $prov->pvEst = 1;
                $prov->save();

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
    public function destroy($pvId)
    {
        try {
            DB::transaction(function () use ($pvId) {
                $prov = Proveedor::findOrFail($pvId);
                ($prov->pvEst === 1) ? $prov->pvEst = 0 : $prov->pvEst = 1;
                $prov->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }
    public function obtenerProveedor(){
        return datatables::of(Proveedor::obtenerProveedor())->make(true);
    }
    public function obtenerProveedorEditar($idprov){
        $result = Proveedor::obtenerProveedorEditar($idprov);
        return response()->json(array('error' => 0, 'result' => $result));

    }
    public function getProveedor(){
        $result = Proveedor::getProveedorAct();
        return response()->json(array('error' => 0, 'result' => $result));
    }
    function getProveedorRuc($ruc)
    {

        try {
            $provee= Proveedor::getProveedorRuc($ruc);
            return response()->json(array('error' => 0,'proveedor'=>$provee));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"Proveedor","getProveedorRuc");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
