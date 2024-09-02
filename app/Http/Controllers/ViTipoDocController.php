<?php

namespace App\Http\Controllers;

use App\reEntidad;
use App\ViTipoDoc;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class ViTipoDocController extends Controller
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
                $tipdoc=New ViTipoDoc();
                $tipdoc->tDDes=$request->desctip;
                $tipdoc->tDUsuReg = Auth::user()->id;
                $tipdoc->tDFecCrea = UtilController::fecha();
                $tipdoc->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ViTipoDocController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ViTipoDoc  $viTipoDoc
     * @return \Illuminate\Http\Response
     */
    public function show(ViTipoDoc $viTipoDoc)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ViTipoDoc  $viTipoDoc
     * @return \Illuminate\Http\Response
     */
    public function edit($idtipd)
    {
        try{
            Return ViTipoDoc::where('tDId','=',$idtipd)->first();
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViTipoDocController","edit");
            return response(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ViTipoDoc  $viTipoDoc
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            DB::transaction(function () use ($request) {
                $tipdoc= ViTipoDoc::findOrfail($request->idtipdoc);
                $tipdoc->tDDes=$request->desctip;
                $tipdoc->tDUsuMod = Auth::user()->id;
                $tipdoc->tDFecmod = UtilController::fecha();
                $tipdoc->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ViTipoDocController","update");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ViTipoDoc  $viTipoDoc
     * @return \Illuminate\Http\Response
     */
    public function destroy($idtipd)
    {
        try{
            DB::transaction(function() use($idtipd){
                $tipdoc=ViTipoDoc::findOrfail($idtipd);
                ($tipdoc->tDEst === 1) ? $tipdoc->tDEst = 0 : $tipdoc->tDEst = 1;
                $tipdoc->tDUsuMod = Auth::user()->id;
                $tipdoc->tDFecmod = UtilController::fecha();
                $tipdoc->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViTipoDocContoller","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getTipDoc()
    {
        try{
            return datatables::of(ViTipoDoc::select('tDId','tDDes',
                DB::raw("DATE_FORMAT(tDFecCrea,'%d-%m-%Y') as tDFecCrea"),'tDEst')
                ->orderby('tDFecCrea','desc')->get())->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViTipoDocController","getEnti");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function validarTipDoc($des)
    {
        try{
            $tipdoc = ViTipoDoc::where(['tDDes' => $des])->select('tDId','tDDes','tDEst')->get();
            return response()->json(array('error' => 0, 'tipdoc' => $tipdoc));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ViTipoDocController","validarTipDoc");
            return response(array('error'=>$e->getMessage()));
        }

    }
}
