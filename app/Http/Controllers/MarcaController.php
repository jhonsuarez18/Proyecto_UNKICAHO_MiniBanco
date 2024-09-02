<?php

namespace App\Http\Controllers;

use App\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\DataTables;

class MarcaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getMarca()
    {
        return Marca::all();
    }
    public function index()
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
        try {
            DB::transaction(function () use ($request) {
                $marca = New Marca();
                $marca->mDesc = $request->marca;
                $marca->mFecCrea = UtilController::fecha();;
                $marca->mUsuReg = Auth::user()->id;
                $marca->mEst = 1;
                $marca->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $marca = Marca::findOrFail($request->idmarca);
                $marca->mDesc = $request->marca;
                $marca->mFecActualiza = UtilController::fecha();;
                $marca->mUsuReg = Auth::user()->id;
                $marca->mEst = 1;
                $marca->save();

            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($mId)
    {
        try {
            DB::transaction(function () use ($mId) {
                $marca = Marca::findOrFail($mId);
                ($marca->mEst === 1) ? $marca->mEst = 0 : $marca->mEst = 1;
                $marca->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }
    public function obtenerMarca(){
        return datatables::of(Marca::obtenerMarca())->make(true);
    }
    public function obtenerMarcaEditar($idmarca){
        $result = Marca::obtenerMarcaEditar($idmarca);
        return response()->json(array('error' => 0, 'result' => $result));

    }
}
