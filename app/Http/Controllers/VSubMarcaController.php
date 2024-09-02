<?php

namespace App\Http\Controllers;

use App\VSubMarca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class VSubMarcaController extends Controller
{

    public function getModelos($id)
    {
        $mod = new VSubMarca();
        return $mod->modelossubM($id);
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            DB::transaction(function () use ($request) {
                $subm=New VSubMarca();

                $subm->mId=$request->idmarc;
                $subm->sMDesc=$request->descsubmarc;
                $subm->sMUsuReg = Auth::user()->id;
                $subm->sMFecCrea = UtilController::fecha();
                $subm->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"VSubMarcaController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\VSubMarca $vSubMarca
     * @return \Illuminate\Http\Response
     */
    public function show(VSubMarca $vSubMarca)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\VSubMarca $vSubMarca
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            DB::transaction(function () use($request){
                $subm= VSubMarca::findOrfail($request->idsubmarc);

                $subm->mId=$request->idmarc;
                $subm->sMDesc=$request->descsubmarc;
                $subm->sMUsuReg = Auth::user()->id;
                $subm->sMFecCrea = UtilController::fecha();
                $subm->save();
            });
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VSubMarcaController","edit");
            return response()->json(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\VSubMarca $vSubMarca
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, VSubMarca $vSubMarca)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\VSubMarca $vSubMarca
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $subm=VSubMarca::findOrfail($id);
                ($subm->sMEst === 1) ? $subm->sMEst = 0 : $subm->sMEst = 1;
                $subm->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VSubMarcaController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getSubMarcs()
    {
        try{
            return Datatables::of(VSubMarca::join('users','sMUsuReg', '=', 'users.id')
                ->join('v_marca as m','v_sub_marca.mId', '=', 'm.mId')
                ->select('sMId','m.mDesc','sMDesc','users.name as uname','sMEst',
                    DB::raw("DATE_FORMAT(sMFecCrea,'%d-%m-%Y') AS sMFecCrea")))->make(true);
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VSubMarcaController","getSubMarcs");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getSubMarcEdit($id)
    {
        try{
            $subm= VSubMarca::where('sMId','=',$id)->first();
            return response()->json(array('error' => 0, 'subm' => $subm));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VSubMarcaController","getSubMarcEdit");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getSubMarcsAct()
    {
        try{
            $submarc= VSubMarca::where('sMEst','=',1)->get();
            return response()->json(array('error' => 0, 'submarc' => $submarc));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VSubMarcaController","getSubMarcAct");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
