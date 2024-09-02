<?php

namespace App\Http\Controllers;

use App\VMarca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class VMarcaController extends Controller
{

    public function getmarca()
    {
        return VMarca::all();
    }

    public function subMarca($id)
    {

        return VMarca::find($id)->subMarcas;
    }


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
                $marc=New VMarca();

                $marc->mDesc=$request->descmarc;
                $marc->mUsuReg = Auth::user()->id;
                $marc->mFecCrea = UtilController::fecha();
                $marc->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"VMarcaController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\VMarca  $vMarca
     * @return \Illuminate\Http\Response
     */
    public function show(VMarca $vMarca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\VMarca  $vMarca
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            DB::transaction(function () use($request){
                $marc= VMarca::findOrfail($request->idmarc);
                $marc->mDesc=$request->descmarc;
                $marc->mUsuReg = Auth::user()->id;
                $marc->mFecCrea = UtilController::fecha();
                $marc->save();
            });
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VMarcaController","edit");
            return response()->json(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\VMarca  $vMarca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VMarca $vMarca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\VMarca  $vMarca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $marc=VMarca::findOrfail($id);
                ($marc->mEst === 1) ? $marc->mEst = 0 : $marc->mEst = 1;
                $marc->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VMarcaController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getMarcas()
    {
        try{
            return Datatables::of(VMarca::join('users','mUsuReg', '=', 'users.id')
                ->select('mId','mDesc','users.name as uname','mEst',
                    DB::raw("DATE_FORMAT(mFecCrea,'%d-%m-%Y') AS mFecCrea")))->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VMarcaController","getMarcas");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getMarcEdit($id)
    {
        try{
            $marc= VMarca::where('mId','=',$id)->first();
            return response()->json(array('error' => 0, 'marc' => $marc));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VMarcaController","getMarcEdit");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getMarcasAct()
    {
        try{
            $marc= VMarca::where('mEst','=',1)->get();
            return response()->json(array('error' => 0, 'marc' => $marc));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VMarcaController","getMarcasAct");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
