<?php

namespace App\Http\Controllers;

use App\ViComprobante;
use App\ViViatico;
use App\ViTipoDocGast;
use App\ViTipoDoc;
use App\ViGasto;
use App\ViTipoGasto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Yajra\DataTables\Facades\DataTables;

class ViComprobanteController extends Controller
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                // dd($request->tipc);
                $comp = new ViComprobante();
                $comp->tDGId = $request->tipc;
                $comp->cNroDoc = $request->numdoc;
                $comp->cFecha = date('Y-m-d', strtotime($request->feccomp));
                $comp->cRazSoc = json_decode($request->razso);
                $comp->cImp = $request->mont;
                $comp->cUsuReg = Auth::user()->id;
                $comp->vId = $request->idvi;
                $comp->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ViComprobanteController", "store");
            return response()->json(array('error' => $e->getMessage()));
        }

    }

    public function getCompVId($vid)
    {
        try {
            $comp = new ViViatico();
            return Datatables::of($comp->getCompVId($vid))->make(true);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ViComprobanteController", "getCompVId");
            return response()->json(array('error' => $e->getMessage()));
        }
    }


    /**
     * Display the specified resource.
     *
     * @param \App\ViComprobante $viComprobante
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
          $comp=ViComprobante::findOrfail($id);
            $vtd=ViTipoDocGast::findOrfail($comp->tDGId);
           $td=ViTipoDoc::findOrfail($vtd->tDId);
            $ga=ViGasto::findOrfail($vtd->gId);
           $tg=ViTipoGasto::findOrfail($ga->tGId);
          return response()->json(array('error' => 0, 'comp' => $comp, 'tipdoccomp' => $vtd,
              'tipdoc' => $td, 'gast' => $ga,'tipgast' => $tg));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ViComprobanteController", "show");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\ViComprobante $viComprobante
     * @return \Illuminate\Http\Response
     */
    public function edit(ViComprobante $viComprobante)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\ViComprobante $viComprobante
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        DB::transaction(function () use ($request) {
            $comp = ViComprobante::findOrFail($request->idcom);
            $comp->tDGId = $request->tipc;
            $comp->cNroDoc = $request->numdoc;
            $comp->cFecha = date('Y-m-d', strtotime($request->feccomp));
            $comp->cRazSoc = json_decode($request->razso);
            $comp->cImp = $request->mont;
            $comp->cUsuReg = Auth::user()->id;
            $comp->vId = $request->idvi;
            $comp->save();
        });
        return response()->json(array('error' => 0));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\ViComprobante $viComprobante
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $epcomp = ViComprobante::findOrFail($id);
                ($epcomp->cEst === 1) ? $epcomp->cEst = 0 : $epcomp->cEst = 1;
                $epcomp->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ViComprobanteController", "destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
