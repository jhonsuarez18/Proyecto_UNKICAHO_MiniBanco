<?php

namespace App\Http\Controllers;

use App\VVehiculo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class VVehiculoController extends Controller
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        try {
            DB::transaction(function () use ($request) {
                $vehi = new VVehiculo();
                $vehi->mTVId = $request->tipva;
                $vehi->oEId = $request->idoficent;
                $vehi->vPlaca = $request->placva;
                $vehi->vCodPatri = $request->codp;
                $vehi->vConKil = $request->conka;
                $vehi->vNChasis = $request->nchasis;
                $vehi->vNMotor = $request->nmotor;
                $vehi->vColor = $request->color;
                $vehi->vNmAro= $request->nrar;
                $vehi->vAnofab= $request->anfab;
                $vehi->vUsuReg = Auth::user()->id;
                $vehi->save();
            });
            return response()->json(array('error' => 0));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VVehiculoController", "store");
            return response(array('error' => $e->getMessage()));
        }
    }

    public function getVehiculos()
    {

    }

    /**
     * Display the specified resource.
     *
     * @param \App\VVehiculo $vVehiculo
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        try {
            $ve = new VVehiculo();
            return Datatables::of($ve->showVehiculo())->make(true);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VVehiculoController", "getReferenciasEstablecimiento");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\VVehiculo $vVehiculo
     * @return \Illuminate\Http\Response
     */
    public function edit($idVehiculo)
    {

        try {
            $ve = new VVehiculo();
            return $ve->showVehiculoEdit($idVehiculo);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VVehiculoController", "edit");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\VVehiculo $vVehiculo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $vehi = VVehiculo::findOrFail($request->veid);
                $vehi->mTVId = $request->tipve;
                $vehi->oEId = $request->idoficente;
                $vehi->vPlaca = $request->placve;
                $vehi->vCodPatri = $request->codpe;
                $vehi->vConKil = $request->conke;
                $vehi->vNChasis = $request->nchasis;
                $vehi->vNMotor = $request->nmotor;
                $vehi->vColor = $request->color;
                $vehi->vNmAro= $request->nrar;
                $vehi->vAnofab= $request->anfab;
                $vehi->vUsuReg = Auth::user()->id;
                $vehi->save();
            });
            return response()->json(array('error' => 0));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VVehiculoController", "edit");
            return response(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\VVehiculo $vVehiculo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        try {
            DB::transaction(function () use ($id) {
                $ve = VVehiculo::findOrFail($id);
                ($ve->vEst === 1) ? $ve->vEst = 0 : $ve->vEst = 1;
                $ve->save();
            });
            return response()->json(array('error' => 0));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VVehiculoController", "edit");
            return response(array('error' => $e->getMessage()));
        }
    }


    public function valPlaca($numplaca)
    {
        $vehi = VVehiculo::where('vPlaca', $numplaca)->select(DB::raw('count(vId) as cant'))->get();
        return response()->json(array('error' => 0, 'vei' => $vehi));
    }
    function getVehiPlac($plc)
    {
        try {
            $veh =VVehiculo::getVehiPlaca($plc);
            return response()->json(array('error' => 0, 'veh'=>$veh));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"RePersonalController","getChoferDni");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

}
