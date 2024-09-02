<?php

namespace App\Http\Controllers;

use App\EPFinalidad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class EpFinalidadController extends Controller
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
                $fin=New EPFinalidad();

                $fin->fCodProducto=$request->codpro;
                $fin->fDescProducto=$request->descpro;
                $fin->fCodActividad=$request->codact;
                $fin->fDescActividad=$request->descact;
                $fin->fCodFinalidad=$request->codfin;
                $fin->fDescFinalidad=$request->descfin;
                $fin->fUsuReg = Auth::user()->id;
                $fin->fFecCrea = UtilController::fecha();
                $fin->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"EpFinalidadController","store");
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
                $fin= EPFinalidad::findOrfail($request->idfin);
                $fin->fCodProducto=$request->codpro;
                $fin->fDescProducto=$request->descpro;
                $fin->fCodActividad=$request->codact;
                $fin->fDescActividad=$request->descact;
                $fin->fCodFinalidad=$request->codfin;
                $fin->fDescFinalidad=$request->descfin;
                $fin->fFecCrea=UtilController:: fecha();
                $fin->fUsuReg=Auth::user()->id;
                $fin->save();
            });
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"EpFinalidadController","edit");
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
        //
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
                $fin=EPFinalidad::findOrfail($id);
                ($fin->fEst === 1) ? $fin->fEst = 0 : $fin->fEst = 1;
                $fin->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"EpFinalidadController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getFin()
    {
        return Datatables::of(EPFinalidad::join('users','fUsuReg', '=', 'users.id')
            ->select('fId','fCodProducto','fDescProducto','fCodActividad','fDescActividad','fCodFinalidad','fDescFinalidad',
                DB::raw("DATE_FORMAT(fFecCrea,'%d-%m-%Y') AS fFecCrea"),'users.name as uname','fEst')
            ->orderby( DB::raw("DATE_FORMAT(fFecCrea,'%Y-%m-%d')"),'desc'))->make(true);
    }
    public function getFinEdit($id)
    {
        Return EPFinalidad::where('fId','=',$id)->first();
    }
    public function validarFin($id)
    {
        $fin = EPFinalidad::where(['fCodFinalidad' => $id])->select('fId','fCodFinalidad','fEst')->get();
        return response()->json(array('error' => 0, 'fin' => $fin));
    }
}
