<?php

namespace App\Http\Controllers;

use App\VMarca;
use App\VTipoCombustible;
use App\VTipoVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class VTipoVehiculoController extends Controller
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
                $tipv=New VTipoVehiculo();

                $tipv->tVDesc=$request->desctipvehic;
                $tipv->tVUsuReg = Auth::user()->id;
                $tipv->tVFecCrea = UtilController::fecha();
                $tipv->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"VTipoVehiculoController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VTipoVehiculo  $vTypoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function show(VTipoVehiculo $vTypoVehiculo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VTipoVehiculo  $vTypoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit(Request  $request)
    {
        try{
            DB::transaction(function () use($request){
                $tipv= VTipoVehiculo::findOrfail($request->idtipvehic);
                $tipv->tVDesc=$request->desctipvehic;
                $tipv->tVUsuReg = Auth::user()->id;
                $tipv->tVFecCrea = UtilController::fecha();
                $tipv->save();
            });
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VTipoVehiculoController","edit");
            return response()->json(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VTipoVehiculo  $vTypoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VTipoVehiculo $vTypoVehiculo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VTipoVehiculo  $vTypoVehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $tipv=VTipoVehiculo::findOrfail($id);
                ($tipv->tVEst === 1) ? $tipv->tVEst = 0 : $tipv->tVEst = 1;
                $tipv->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VTipoVehiculoController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getTipVehics()
    {
        try{
            return Datatables::of(VTipoVehiculo::join('users','tVUsuReg', '=', 'users.id')
                ->select('tVId','tVDesc','users.name as uname','tVEst',
                    DB::raw("DATE_FORMAT(tVFecCrea,'%d-%m-%Y') AS tVFecCrea")))->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VTipoVehiculoController","getTipVehics");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getTipVehicEdit($id)
    {
        try{
            $tipv= VTipoVehiculo::where('tVId','=',$id)->first();
            return response()->json(array('error' => 0, 'tipvehic' => $tipv));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VTipoVehiculoController","geTipVehicEdit");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getTipVehicAct()
    {
        try{
            $tipv= VTipoVehiculo::where('tVEst','=',1)->get();
            return response()->json(array('error' => 0, 'tipv' => $tipv));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VTipoVehiculoController","getTipVehicAct");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
