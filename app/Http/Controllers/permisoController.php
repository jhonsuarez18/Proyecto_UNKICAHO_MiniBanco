<?php

namespace App\Http\Controllers;

use App\permiso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;

class permisoController extends Controller
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
    public static function store($idsub,$iduser)
    {
        try{
            $perm=New permiso();

            $perm->idSubMenu=$idsub;
            $perm->idUsuario=$iduser;
            $perm->usuCrea = Auth::user()->id;
            $perm->usuModifica = Auth::user()->id;
            $perm->fecModifica = UtilController::fecha();
            $perm->fecCreacion = UtilController::fecha();
            $perm->save();
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"permisoController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
        /*try{
            DB::transaction(function () use ($request) {
                $perm=New permiso();

                $perm->idSubMenu=$request->idsubmenu;
                $perm->idUsuario=$request->iduser;
                $perm->usuCrea = Auth::user()->id;
                $perm->usuModifica = Auth::user()->id;
                $perm->fecModifica = UtilController::fecha();
                $perm->fecCreacion = UtilController::fecha();
                $perm->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"permisoController","store");
            return response()->json(array('error' => $e->getMessage()));
        }*/
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
    public static function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $perm=permiso::findOrfail($id);
                ($perm->estado === 1) ? $perm->estado = 0 : $perm->estado = 1;
                $perm->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"permisoController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public static function deletepermref($id)
    {
        try{
            DB::transaction(function() use($id){
                $perm=permiso::findOrfail($id);
                $perm->estado = 0;
                $perm->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"permisoController","deletepermref");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
