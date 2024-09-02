<?php

namespace App\Http\Controllers;
use App\EPfuenteFinanciamiento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class FuenteFinanciamientoController extends Controller
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
                $fuenf=New EPfuenteFinanciamiento();

                $fuenf->fFCod=$request->fFcod;
                $fuenf->fFdesc=$request->desfuen;
                $fuenf->fFFecCrea = UtilController::fecha();
                $fuenf->fFUsuReg = Auth::user()->id;
                $fuenf->save();
            });

            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"FuenteFinanciamientoController","store");
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
        //AGREGADO 13-12-2020
        try{
            DB::transaction(function() use($request){
                $fuen=EPfuenteFinanciamiento::findOrfail($request->idff);
                $fuen->fFdesc=$request->descfuen;
                $fuen->fFFecCrea=UtilController::fecha();
                $fuen->fFUsuReg=Auth::User()->id;
                $fuen->save();

            });

            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"FuenteFinanciamientoController","edit");
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

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //AGREGADO 13-12-2020
        try {
            DB::transaction(function () use ($id) {
                $fuen = EPfuenteFinanciamiento::findOrFail($id);
                ($fuen->fFEst === 1) ? $fuen->fFEst = 0 : $fuen->fFEst = 1;
                $fuen->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"FuenteFinanciamientoController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getFuenF(){
        return Datatables::of(EPfuenteFinanciamiento::join('users','fFUsuReg', '=', 'users.id')
            ->select(DB::raw("fFId,fFCod,fFdesc, DATE_FORMAT(fFFecCrea,'%d-%m-%Y') AS fFFecCrea,users.name as uname,fFEst")))->make(true);
    }
    public function ValidarFuenF($ff){
        $fuen = EPfuenteFinanciamiento::where(['fFdesc' => $ff])->select('fFId','fFdesc','fFEst')->get();
        return response()->json(array('error' => 0, 'fuen' => $fuen));

    }
    public function getFuenEdit($id){
        Return EPfuenteFinanciamiento::where('fFId','=',$id)->first();
    }
}
