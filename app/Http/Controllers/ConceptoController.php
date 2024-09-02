<?php

namespace App\Http\Controllers;
use App\EPConcepto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class ConceptoController extends Controller
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
                $concep=New EPConcepto();

                $concep->cDescripcion=$request->desconcep;
                $concep->cUsuReg = Auth::user()->id;
                $concep->cFecCreacion = UtilController::fecha();
                $concep->save();
            });

            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ConceptoController","store");
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
                $concep=EPConcepto::findOrfail($request->idconcep);
                $concep->cDescripcion=$request->descconcep;
                $concep->cUsuReg=Auth::User()->id;
                $concep->cFecCreacion=UtilController::fecha();
                $concep->save();

            });

            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"ConceptoController","edit");
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
        //AGREGADO 13-12-2020
        try {
            DB::transaction(function () use ($id) {
                $concep = EPConcepto::findOrFail($id);
                ($concep->cEstado === 1) ? $concep->cEstado = 0 : $concep->cEstado = 1;
                $concep->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ConceptoController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getConcept()
    {
        return Datatables::of(EPConcepto::join('users','cUsuReg', '=', 'users.id')
            ->select(DB::raw("cId,cDescripcion,cUsuReg, DATE_FORMAT(cFecCreacion,'%d-%m-%Y') AS cFecCrea,users.name as uname, cEstado")))->make(true);
    }
    public function ValidarConcept($id)
    {
        $concep = EPConcepto::where(['cDescripcion' => $id])->select('cId','cDescripcion','cEstado')->get();
        return response()->json(array('error' => 0, 'concep' => $concep));

    }
    public function getConceptEdit($id)
    {
        Return EPConcepto::where('cId','=',$id)->first();
    }
}
