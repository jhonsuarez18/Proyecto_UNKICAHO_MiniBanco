<?php

namespace App\Http\Controllers;

use App\reDocFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\DataTables;

class ReDocFileController extends Controller
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param \App\reDocFile $reDocFile
     * @return \Illuminate\Http\Response
     */
    public function show(reDocFile $reDocFile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\reDocFile $reDocFile
     * @return \Illuminate\Http\Response
     */
    public function edit(reDocFile $reDocFile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\reDocFile $reDocFile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reDocFile $reDocFile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\reDocFile $reDocFile
     * @return \Illuminate\Http\Response
     */
    public function destroy(reDocFile $reDocFile)
    {
        //
    }


    public function getEstFile($idr)
    {
        try {
            $plaz = new reDocFile();
            return Datatables::of($plaz->getEstFile($idr))->make(true);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ReDocFileController", "getEstFile");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
