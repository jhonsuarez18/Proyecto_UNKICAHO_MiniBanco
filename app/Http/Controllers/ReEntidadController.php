<?php

namespace App\Http\Controllers;

use App\reEntidad;
use App\reOficina;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class ReEntidadController extends Controller
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
                $enti=New reEntidad();
                $enti->eDesc=$request->nomenti;
                $enti->eUsuReg = Auth::user()->id;
                $enti->eFecCrea = UtilController::fecha();
                $enti->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ReEntidadController","store");
            return response()->json(array('error' => $e->getMessage()));
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
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            DB::transaction(function () use($request){
                $enti= reEntidad::findOrfail($request->identi);
                $enti->eDesc=$request->nomenti;
                $enti->eUsuReg = Auth::user()->id;
                $enti->eFecCrea = UtilController::fecha();
                $enti->save();
            });
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReEntidadController","edit");
            return response()->json(array('error'=>$e->getMessage()));
        }
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $enti=reEntidad::findOrfail($id);
                ($enti->eEst === 1) ? $enti->eEst = 0 : $enti->eEst = 1;
                $enti->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReEntidadController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getEnti()
    {
        try{
            return datatables::of(reEntidad::select('eId','eDesc',
                DB::raw("DATE_FORMAT(eFecCrea,'%d-%m-%Y') as eFecCrea"),'eEst')
                ->orderby('eFecCrea','desc')->get())->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReEntidadController","getEnti");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getEntiEdit($id)
    {
        try{
            Return reEntidad::where('eId','=',$id)->first();
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReEntidadController","getEntiEdit");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function validarEnti($des)
    {
        try{
            $enti = reEntidad::where(['eDesc' => $des])->select('eId','eDesc','eEst')->get();
            return response()->json(array('error' => 0, 'enti' => $enti));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReEntidadController","getEntiEdit");
            return response(array('error'=>$e->getMessage()));
        }

    }
}
