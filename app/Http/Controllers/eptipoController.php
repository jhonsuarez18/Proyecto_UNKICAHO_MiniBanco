<?php

namespace App\Http\Controllers;

use App\ALStock;
use App\EPTipo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class EPTipoController extends Controller
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
                $tipos=New EPTipo();

             $tipos->tCod=$request->tcod;
             $tipos->tDesc=$request->destip;
             $tipos->tFecCrea = UtilController::fecha();
             $tipos->tUsuReg = Auth::user()->id;
             $tipos->save();
            });

            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"eptipoController","store");
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
        //AGREGADO 19-11-2020
        try{
            DB::transaction(function() use($request){
                $tip=EPTipo::findOrfail($request->idtip);
                $tip->tdesc=$request->desctip;
                $tip->tFecCrea=UtilController::fecha();
                $tip->tUsuReg=Auth::User()->id;
                $tip->save();

            });

            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"eptipoController","edit");
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
        //AGREGADO 19-11-2020
        try {
            DB::transaction(function () use ($id) {
                $tip = EPTipo::findOrFail($id);
                ($tip->tEst === 1) ? $tip->tEst = 0 : $tip->tEst = 1;
                $tip->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"eptipoController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getTipo(){
        return Datatables::of(EPTipo::join('users','tUsuReg', '=', 'users.id')
            ->select('tId','tCod','tdesc',DB::raw("DATE_FORMAT(tFecCrea,'%d-%m-%Y') AS tFecCrea"),'users.name as uname','tEst'))->make(true);
    }
    public function getTipEdit($id){
         Return EPTipo::where('tid','=',$id)->first();
    }
    public function ValidarTipoPedido($tip){
        //$tipo = EPTipo::where(['tdesc' => $tip])->select(DB::raw('count(tdesc) as cant'))->get();
        $tipo = EPTipo::where(['tdesc' => $tip])->select('tId','tdesc','tEst')->get();
       return response()->json(array('error' => 0, 'tip' => $tipo));

    }
}
