<?php

namespace App\Http\Controllers;

use App\VModeloTipoVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;

class VModeloTipoVehiculoController extends Controller
{
    public function getTipVehiculoId($idModelo)
    {
        $mtv = new VModeloTipoVehiculo();
        return $mtv->getTipoVehiculoId($idModelo);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return Datatables(VModeloTipoVehiculo::getModelTipVehic())->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VModeloTipoVehiculoController","index");
            return response(array('error'=>$e->getMessage()));
        }
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::transaction(function () use ($request) {
                $modeltipv=New VModeloTipoVehiculo();

                $modeltipv->tVId=$request->idtv;
                $modeltipv->mId=$request->idmodel;
                $modeltipv->mTVUsuReg = Auth::user()->id;
                $modeltipv->mTVFecCrea = UtilController::fecha();
                $modeltipv->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"VModeloTipoVehiculoController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\VModeloTipoVehiculo $vModeloTipoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(VModeloTipoVehiculo $vModeloTipoVehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\VModeloTipoVehiculo $vModeloTipoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $modeltipv= VModeloTipoVehiculo::where('mTVId','=',$id)->first();
            return response()->json(array('error' => 0, 'modeltipv' => $modeltipv));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VModeloTipoVehiculoController","edit");
            return response(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\VModeloTipoVehiculo $vModeloTipoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            DB::transaction(function () use($request){
                $modeltipv= VModeloTipoVehiculo::findOrfail($request->idmtv);

                $modeltipv->tVId=$request->idtv;
                $modeltipv->mId=$request->idmodel;
                $modeltipv->mTVUsuReg = Auth::user()->id;
                $modeltipv->mTVFecCrea = UtilController::fecha();
                $modeltipv->save();
            });
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VModeloTipoVehiculoController","update");
            return response()->json(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\VModeloTipoVehiculo $vModeloTipoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $modeltipv=VModeloTipoVehiculo::findOrfail($id);
                ( $modeltipv->mTVEst === 1) ?  $modeltipv->mTVEst = 0 :  $modeltipv->mTVEst = 1;
                $modeltipv->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VModeloTipoVehiculoController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
