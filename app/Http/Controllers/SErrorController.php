<?php

namespace App\Http\Controllers;
use App\S_Error;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class SErrorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            return view('intranet.Convenios.segurointegralsalud.datos.error');
        } catch (Exception $e) {

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
      //
    }
    public static function saveerror($desc,$clase,$metodo)
    {
        $error=New S_Error();
        $error->eDescripcion=$desc;
        $error->eClase=$clase;
        $error->eMetodo=$metodo;
        $error->eUsuReg = Auth::user()->id;
        $error->eFecCrea = UtilController::fecha();
        $error->eEst=1;
        $error->save();
        return response()->json(array('error' => 0));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\S_Error  $s_Error
     * @return \Illuminate\Http\Response
     */
    public function show(S_Error $s_Error)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\S_Error  $s_Error
     * @return \Illuminate\Http\Response
     */
    public function edit(S_Error $s_Error)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\S_Error  $s_Error
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, S_Error $s_Error)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\S_Error  $s_Error
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $error=S_Error::findOrfail($id);
                ($error->eEst === 1) ? $error->eEst = 0 : $error->eEst = 1;
                $error->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            //SErrorController::saveerror($e->getMessage(),"SErrorController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getErrores()
    {
        return Datatables::of(S_Error::select('eId','eDescripcion','eClase','eMetodo',DB::raw("DATE_FORMAT(eFecCrea,'%d-%m-%Y') AS eFecCrea"),'eUsuReg','eEst'))->make(true);
    }
}
