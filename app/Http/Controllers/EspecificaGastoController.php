<?php

namespace App\Http\Controllers;
use App\EPEspecificaGasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class EspecificaGastoController extends Controller
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
                $espg=New EPEspecificaGasto();
                $espg->eGCod=$request->codespg;
                $espg->eGDesc=$request->descespg;
                $espg->eGFecCrea = UtilController::fecha();
                $espg->eGUsuReg = Auth::user()->id;
                $espg->save();
            });

            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"EspecificaGastoController","store");
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
        //AGREGADO 14-12-2020
        try{
            DB::transaction(function() use($request){
                $espg=EPEspecificaGasto::findOrfail($request->idespg);
                $espg->eGCod=$request->codespg;
                $espg->eGDesc=$request->descespg;
                $espg->eGFecCrea=UtilController::fecha();
                $espg->eGUsuReg=Auth::User()->id;
                $espg->save();

            });

            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"EspecificaGastoController","edit");
            return response()->json(array('error' => $e->getMessage()));
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
        //AGREGADO 14-12-2020
        try {
            DB::transaction(function () use ($id) {
                $espg = EPEspecificaGasto::findOrFail($id);
                ($espg->eGEst === 1) ? $espg->eGEst = 0 : $espg->eGEst = 1;
                $espg->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"EspecificaGastoController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getEspeG()
    {
        return Datatables::of(EPEspecificaGasto::join('users','eGUsuReg', '=', 'users.id')
        ->select(DB::raw("eGId,eGCod,eGDesc,DATE_FORMAT(eGFecCrea,'%d-%m-%Y') AS eGFecCrea,users.name as uname, eGEst")))->make(true);
    }
    public function ValidarEspeG($id,$desc)
    {
        $espg = EPEspecificaGasto::where(['eGCod' => $id,'eGDesc'=>$desc])->select('eGId','eGDesc','eGEst')->get();
        return response()->json(array('error' => 0, 'espg' => $espg));

    }
    public function getEspeGEdit($id)
    {
        Return EPEspecificaGasto::where('eGId','=',$id)->first();
    }
}
