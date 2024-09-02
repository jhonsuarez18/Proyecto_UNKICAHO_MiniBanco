<?php

namespace App\Http\Controllers;
use App\reDocumento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;
use Yajra\DataTables\DataTables;

class ReDocumentoController extends Controller
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
                $doc=New reDocumento();

                $doc->dTitulo=$request->titdoc;
                $doc->dDescripcion=$request->desdoc;
                $doc->dUsuReg = Auth::user()->id;
                $doc->dFecCrea = UtilController::fecha();
                $doc->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ReDocumentoController","store");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\reDocumento  $reDocumento
     * @return \Illuminate\Http\Response
     */
    public function show(reDocumento $reDocumento)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\reDocumento  $reDocumento
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try{
            DB::transaction(function () use($request){
                $doc=reDocumento::findOrfail($request->iddoc);
                $doc->dTitulo=$request->titdoc;
                $doc->dDescripcion=$request->descdoc;
                $doc->dFecCrea=UtilController:: fecha();
                $doc->dUsuReg=Auth::user()->id;
                $doc->save();
            });
            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReDocumentoController","edit");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\reDocumento  $reDocumento
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reDocumento $reDocumento)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\reDocumento  $reDocumento
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function() use($id){
                $doc=reDocumento::findOrfail($id);
                ($doc->dEst === 1) ? $doc->dEst = 0 : $doc->dEst = 1;
                $doc->save();
            });
            return response(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ReDocumentoController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getDoc()
    {
        return Datatables::of(reDocumento::join('users','dUsuReg', '=', 'users.id')
            ->select('dId','dTitulo','dDescripcion',DB::raw("DATE_FORMAT(dFecCrea,'%d-%m-%Y') AS dFecCrea"),'users.name as uname','dEst'))->make(true);
    }
    public function getDocEdit($id)
    {
        Return reDocumento::where('dId','=',$id)->first();
    }
}
