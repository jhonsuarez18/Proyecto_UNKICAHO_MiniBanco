<?php

namespace App\Http\Controllers;

use App\reUsuOfi;
use App\u_notificacion;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use vakata\database\Exception;

class UNotificacionController extends Controller
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
                $iduo=$this->getidUs($request->idof);
                foreach ($iduo as $idu){
                    $idusu=$idu->id;
                }
                $notif=new u_notificacion();
                $notif->uId=$idusu;
                $notif->nTitulo=json_decode($request->notif);
                $notif->nMensaje=json_decode($request->notif);
                $notif->nEstNotifi=1;
                $notif->nUsuReg=Auth::user()->id;
                $notif->nFecCrea=UtilController::fecha();
                $notif->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"UNotificacionController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\u_notificacion  $u_notificacion
     * @return \Illuminate\Http\Response
     */
    public function show(u_notificacion $u_notificacion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\u_notificacion  $u_notificacion
     * @return \Illuminate\Http\Response
     */
    public function edit(u_notificacion $u_notificacion)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\u_notificacion  $u_notificacion
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, u_notificacion $u_notificacion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\u_notificacion  $u_notificacion
     * @return \Illuminate\Http\Response
     */
    public function destroy($idn)
    {
        try {
            DB::transaction(function () use ($idn) {
                $notif = u_notificacion::findOrFail($idn);
                $notif->nEstNotifi = 0;
                $notif->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"UNotificacionController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getidUs($id){
       try{
                return reUsuOfi::where('oEId','=',$id)->get();
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"UNotificacionController","getidUs");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function getNotif($idus){
        try{
            return u_notificacion::where('uId','=',$idus)->where('nEstNotifi','=',1)->get();
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"UNotificacionController","getNotif");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
