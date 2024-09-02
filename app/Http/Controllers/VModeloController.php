<?php

namespace App\Http\Controllers;

use App\VMarca;
use App\VModelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class VModeloController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try{
            return Datatables::of(VModelo::join('users','mUsuReg', '=', 'users.id')
                ->join('v_sub_marca as sm','v_modelo.sMId', '=', 'sm.sMId')
                ->join('v_tipo_combustible as tc','v_modelo.tCId', '=', 'tc.tCId')
                ->select('v_modelo.mId','v_modelo.mDesc','sm.sMDesc','tc.tCDesc','users.name as uname','mEst',
                    DB::raw("DATE_FORMAT(mFecCrea,'%d-%m-%Y') AS mFecCrea")))->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VModeloController","index");
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::transaction(function () use ($request) {
                $model=New VModelo();

                $model->sMId=$request->idsubm;
                $model->tCId=$request->idtipcomb;
                $model->mDesc=$request->descmodel;
                $model->mUsuReg = Auth::user()->id;
                $model->mFecCrea = UtilController::fecha();
                $model->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"VModeloController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VModelo  $vModelo
     * @return \Illuminate\Http\Response
     */
    public function show(VModelo $vModelo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VModelo  $vModelo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $model= VModelo::where('mId','=',$id)->first();
            return response()->json(array('error' => 0, 'model' => $model));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VModeloController","edit");
            return response(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VModelo  $vModelo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try{
            DB::transaction(function () use($request){
                $model= VModelo::findOrfail($request->idmodel);

                $model->sMId=$request->idsubm;
                $model->tCId=$request->idtipcomb;
                $model->mDesc=$request->descmodel;
                $model->mUsuReg = Auth::user()->id;
                $model->mFecCrea = UtilController::fecha();
                $model->save();
            });
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VModeloController","update");
            return response()->json(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VModelo  $vModelo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $model=VModelo::findOrfail($id);
                ($model->mEst === 1) ? $model->mEst = 0 : $model->mEst = 1;
                $model->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VModeloController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getModelsAct()
    {
        try{
            $model= VModelo::getModelsAct();
            return response()->json(array('error' => 0, 'model' => $model));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VModeloController","getModelsAct");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
