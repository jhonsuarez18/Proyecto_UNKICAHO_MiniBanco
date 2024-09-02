<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use App\reAfiliado;
use App\rePacTipSeg;
use Yajra\DataTables\DataTables;

class ReAfiliadoController extends Controller
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
        //
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
    public function edit($id)
    {
        //
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
        //
    }
    public function getAfiliadoDni($dni)
    {
        try {
            $afil = new reAfiliado();
            $respp = $afil->getAfiliadoDni($dni);
            /// si no esta buscar en su salud o reniec
            $tipSeg = new rePacTipSeg();
            $respTs = $tipSeg->getTipSeg($respp->afi_DNI);
            return response()->json(array('error' => 0, 'afiliado' => $respp, 'tipsSeg' => $respTs));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), 'ReAfiliadoController', 'getAfiliadoDni');
            return response()->json(array('error' => $e->getMessage()));
        }

    }
    public function getbenefi($dni,$nomb){
        return datatables::of(reAfiliado::getAfiliadoDniNomb($dni,$nomb))->make(true);
    }
}
