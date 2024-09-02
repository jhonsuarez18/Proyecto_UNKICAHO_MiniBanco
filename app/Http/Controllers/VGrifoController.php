<?php

namespace App\Http\Controllers;

use App\VGrifo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class VGrifoController extends Controller
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

    public function getGrifos()
    {
        try {
            return Datatables::of(VGrifo::join('users','gUsuReg', '=', 'users.id')
                ->select('gid','gRuc','users.name as uname','gEst','gDesc',
                    DB::raw("DATE_FORMAT(gFecCrea,'%d-%m-%Y') AS gFecCrea")))->make(true);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VGrifoController", "getGrifos");
            return response(array('error' => $e->getMessage()));
        }
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
                $grif = new VGrifo();
                $grif->gRuc = $request->ruc ;
                $grif->gDesc = $request->descgrif;
                $grif->gUsuReg = Auth::user()->id;
                $grif->gFecCrea = UtilController::fecha();
                $grif->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VGrifoController", "store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\VGrifo $vGrifo
     * @return \Illuminate\Http\Response
     */
    public function show(VGrifo $vGrifo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\VGrifo $vGrifo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $vgrif= VGrifo::where('gId','=',$id)->first();
            return response()->json(array('error' => 0, 'grifo' => $vgrif));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VMarcaController","getMarcEdit");
            return response(array('error'=>$e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\VGrifo $vGrifo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $grif = VGrifo::findOrFail($request->idedgrif);
                $grif->gRuc = $request->edruc;
                $grif->gDesc = $request->eddescgrif;
                $grif->gUsuReg = Auth::user()->id;
                $grif->gFecCrea = UtilController::fecha();
                $grif->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "VGrifoController", "update");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\VGrifo $vGrifo
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $grif=VGrifo::findOrfail($id);
                ($grif->gEst === 1) ? $grif->gEst = 0 : $grif->gEst = 1;
                $grif->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VMarcaController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getGrifoAct()
    {
        try{
                $grif=VGrifo::where('gEst','=',1)->get();
            return response()->json(array('error' => 0, 'grif' => $grif));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"VMarcaController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
}
