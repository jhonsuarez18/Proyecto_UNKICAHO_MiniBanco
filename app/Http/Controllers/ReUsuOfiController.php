<?php

namespace App\Http\Controllers;
use App\ALEncargado;
use App\reUsuOfi;
use App\permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class ReUsuOfiController extends Controller
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
                $usofic=New reUsuOfi();

                $usofic->oEId=$request->idoficent;
                $usofic->id=$request->iduser;
                $usofic->uOUsuReg = Auth::user()->id;
                $usofic->uOFecCrea = UtilController::fecha();
                $usofic->save();
                if($request->idper==0){
                    permisoController::store($request->idsubm,$request->iduser);
                }else{
                    permisoController::destroy($request->idper);
                }
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ReUsuOfiController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reUsuOfi  $reUsuOfi
     * @return \Illuminate\Http\Response
     */
    public function show(reUsuOfi $reUsuOfi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reUsuOfi  $reUsuOfi
     * @return \Illuminate\Http\Response
     */
    public  function edit(Request $request)
    {
        try{
            DB::transaction(function () use ($request) {
                $usofic=reUsuOfi::findOrfail($request->iduofic);
                $usofic->oEId=$request->idoficentedit;
                $usofic->id=$request->idusofedit;
                $usofic->uOUsuReg = Auth::user()->id;
                $usofic->uOFecCrea = UtilController::fecha();
                $usofic->save();
                if($request->idper==0){
                    permisoController::store($request->idsubm,$request->idusofedit);
                    permisoController::destroy($request->idperx);
                }else{
                    if($request->idtipp1!=$request->idtipp2){
                                permisoController::destroy($request->idperx);
                                permisoController::destroy($request->idper);
                    }
                }

            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ReUsuOfiController","edit");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reUsuOfi  $reUsuOfi
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reUsuOfi $reUsuOfi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reUsuOfi  $reUsuOfi
     * @return \Illuminate\Http\Response
     */
    public function destroy($id,$iduser,$idsm)
    {
        try{
            DB::transaction(function() use($id,$iduser,$idsm){
                $usofic=reUsuOfi::findOrfail($id);
                ($usofic->uOEst === 1) ? $usofic->uOEst = 0 : $usofic->uOEst = 1;
                $usofic->save();
                $idper=ReUsuOfiController::getidpermiso($iduser,$idsm);
                permisoController::destroy($idper[0]->idPermiso);
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReUsuOfiController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getUsuOfic()
    {
        return Datatables::of(reUsuOfi::getUsuOficina())->make(true);
    }
    public function getUsuOficEdit($id)
    {
        $usuof= reUsuOfi::getUsuOfEdit($id);
        return response()->json(array('error' => 0, 'usof' => $usuof));
    }
    public function getTrabEss(){
        try {
            $re=new reUsuOfi();
            return response()->json(array(['error' => 0,'ess'=> $re->getTrabEss(Auth::user()->id)]));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReUsuOfiController", "getTrabEss");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function getTrabEnti(){
        try {
            $re=new reUsuOfi();
            return response()->json(array(['error' => 0,'ent'=> $re->getTrabEnti(Auth::user()->id)]));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReUsuOfiController", "getTrabEss");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getidpermiso($iduser,$idsubm){
        try{
            return $per= permiso::getidPermiso($iduser,$idsubm);
            //return response()->json(array('error' => 0, 'per' => $per));
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(), "ReUsuOfiController", "getidpermiso");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function ValUsuarioOfic($idu){
        try{
            $Usua = reUsuOfi::where(['id' => $idu])->select('oEId','id','uOEst')->orderby('uOEst','asc')->get();
            return response()->json(array('error' => 0, 'usof' => $Usua));
        }catch (\Exception $e){
            SErrorController::saveerror($e->getMessage(), "ReUsuOfiController", "ValUsuarioOfic");
            return response()->json(array('error' => $e->getMessage()));
        }

    }
    public function mostrarRegistrarUsuario($idplant)
    {
        try {
            return view('intranet.Convenios.segurointegralsalud.datos.registrarUsuario')->with(['idplantilla' => $idplant]);
        } catch (Exception $e) {
            return $e;
        }
    }
}
