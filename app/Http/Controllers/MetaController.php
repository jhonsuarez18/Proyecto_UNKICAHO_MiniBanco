<?php

namespace App\Http\Controllers;

use App\EPEspecificaGasto;
use App\EPFinalidad;
use App\EPMeta;
use App\EPMetaEpecificaGasto;
use App\EPProgramaPresupuestal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Writer\Ods\Meta;
use Yajra\DataTables\DataTables;

class MetaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function obtenerEspecificasGasto()
    {
        return EPEspecificaGasto::all();
    }

    public function obtenerMetaId($idmeta)
    {
        return EPMeta::obtenerMetaId($idmeta);
    }

    public function obtenerProgramasPresupuestales()
    {
        return EPProgramaPresupuestal::where('pPEst','=',1)->get();
    }

    public function obtenerMetaEspecifica()
    {
        return Datatables::of(EPMeta::obtenerMetaEspecifica())->make(true);
    }

    public function obtenerMetadEspecificaEditar($idmeta)
    {
        $result = EPMeta::obtemerMetadEspecificaEditar($idmeta);
        return response()->json(array('error' => 0, 'result' => $result));
    }

    public function obtenerFinalidad()
    {
        return EPFinalidad::obtenerFinalidad();
    }

    public function ingresarMeta()
    {

    }


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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $meta = New EPMeta();
                $meta->pPId = $request->propre;
                $meta->fId = $request->prod;
                $meta->mCod = $request->nummeta;
                $meta->mSusten = "";
                $meta->mFecCrea = UtilController::fecha();;
                $meta->mUsuReg = Auth::user()->id;
                $meta->mEst = 1;
                $meta->save();
                $idmet = $meta->mId;
                foreach ($request->especifica as $esp) {
                    $metaespg = New EPMetaEpecificaGasto();
                    $metaespg->mId = $idmet;
                    $metaespg->eGId = $esp;
                    $metaespg->mEGFecCrea = UtilController::fecha();
                    $metaespg->mEGUsuReg = Auth::user()->id;
                    $metaespg->mEGEst = 1;
                    $metaespg->save();
                }

            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    public function storeEspecificaGasto($idmet, $esp)
    {
        try {
            DB::transaction(function () use ($idmet, $esp) {
                $eg = EPMetaEpecificaGasto::obtenerEPMetaEpecificaGasto($idmet, $esp);
                if (empty($eg)) {
                    $metaespg = New EPMetaEpecificaGasto();
                    $metaespg->mId = $idmet;
                    $metaespg->eGId = $esp;
                    $metaespg->mEGFecCrea = UtilController::fecha();
                    $metaespg->mEGUsuReg = Auth::user()->id;
                    $metaespg->mEGEst = 1;
                    $metaespg->save();
                } else {
                    $this->addEspecificaGasto($eg->mEGId);
                }

            }

            );
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }

    }

    public function addEspecificaGasto($idEspc)
    {
        DB::transaction(function () use ($idEspc) {
            $metaespg = EPMetaEpecificaGasto::findOrFail($idEspc);
            $metaespg->mEGFecCrea = UtilController::fecha();
            $metaespg->mEGUsuReg = Auth::user()->id;
            $metaespg->mEGEst = 1;
            $metaespg->save();
        }
        );

    }

    public function deleteEspecificaGasto($idEspc)
    {
        try {
            DB::transaction(function () use ($idEspc) {
                $metaespg = EPMetaEpecificaGasto::findOrFail($idEspc);
                $metaespg->mEGFecCrea = UtilController::fecha();
                $metaespg->mEGUsuReg = Auth::user()->id;
                $metaespg->mEGEst = 0;
                $metaespg->save();
            }

            );
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }

    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {

                $meta = EPMeta::findOrFail($request->idmeta);
                $meta->pPId = $request->propre;
                $meta->fId = $request->idfin;
                $meta->mCod = $request->nummeta;
                $meta->mFecCrea = UtilController::fecha();;
                $meta->mUsuReg = Auth::user()->id;
                $meta->mEst = 1;
                $meta->save();


            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function validarMeta($nummeta)
    {

        $meta = EPMeta::where('mCod', $nummeta)->select(DB::raw('count(mId) as cant'))->get();
        return response()->json(array('error' => 0, 'met' => $meta));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function eliminarMeta($mId)
    {
        try {
            DB::transaction(function () use ($mId) {
                $epmeta = EPMeta::findOrFail($mId);
                ($epmeta->mEst === 1) ? $epmeta->mEst = 0 : $epmeta->mEst = 1;
                $epmeta->save();
                $epmetaes = EPMetaEpecificaGasto::where('mId', $epmeta->mId)->get();
                foreach ($epmetaes as $metes) {
                    $espbusc = EPMetaEpecificaGasto::findOrFail($metes->mEGId);
                    ($espbusc->mEGEst === 1) ? $espbusc->mEGEst = 0 : $espbusc->mEGEst = 1;
                    $espbusc->save();
                }


            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }

    }
}
