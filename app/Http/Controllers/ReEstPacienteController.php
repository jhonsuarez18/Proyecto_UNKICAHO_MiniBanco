<?php

namespace App\Http\Controllers;

use App\reDocumento;
use App\reEstPaciente;
use App\rePlazo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class ReEstPacienteController extends Controller
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
                $estp=New reEstPaciente();

                $estp->ePDescripcion=$request->desestp;
                $estp->ePFecCrea=UtilController:: fecha();
                $estp->ePUsuReg=Auth::user()->id;
                $estp->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ReEstPacienteController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reEstPaciente  $reEstPaciente
     * @return \Illuminate\Http\Response
     */
    public function show(reEstPaciente $reEstPaciente)
    {
        //
    }

    public function getEstPac(){
        return reEstPaciente::all();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reEstPaciente  $reEstPaciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            DB::transaction(function () use($request){
                $estp=reEstPaciente::findOrfail($request->idestp);
                $estp->ePDescripcion=$request->desestp;
                $estp->ePFecCrea=UtilController:: fecha();
                $estp->ePUsuReg=Auth::user()->id;
                $estp->save();
            });
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReEstPacienteController","edit");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reEstPaciente  $reEstPaciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reEstPaciente $reEstPaciente)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reEstPaciente  $reEstPaciente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $estp=reEstPaciente::findOrfail($id);
                ($estp->ePEst === 1) ? $estp->ePEst = 0 : $estp->ePEst = 1;
                $estp->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReEstPacienteController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getEstP()
    {
        return Datatables::of(reEstPaciente::join('users','re_est_paciente.ePUsuReg', '=', 'users.id')
            ->select('ePId','ePDescripcion',DB::raw("DATE_FORMAT(ePFecCrea,'%d-%m-%Y') AS ePFecCrea"),'users.name as uname','ePEst'))->make(true);
    }
    public function getEstPEdit($id)
    {
        Return reEstPaciente::where('ePId','=',$id)->first();
    }
    public function validarEstP($est)
    {
        $estp = reEstPaciente::where(['ePDescripcion' => $est])->select('ePId','ePDescripcion','ePEst')->get();
        return response()->json(array('error' => 0, 'estp' => $estp));
    }
}
