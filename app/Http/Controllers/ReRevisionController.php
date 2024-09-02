<?php

namespace App\Http\Controllers;

use App\reRevision;
use App\reUbicacion;
use App\reObservacion;

use App\ViViatico;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PhpParser\Node\Stmt\Echo_;

class ReRevisionController extends Controller
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
            $cond = 0;
            $conobs = 0;
            $rev = reRevision::findOrFail($request->revrid);
            $rev->rEstRev = $request->est;
            $rev->rEstFecRev = UtilController::fecha();
            $rev->save();
            if ($request->op === '2') {
                $obs = new reObservacion();
                $obs->rId = $request->revrid;
                $obs->oMotivo = json_decode($request->obs);
                $obs->rUsuReg = Auth::user()->id;
                $obs->save();
            }
            $ubid = $rev->uId;
            $rev = reRevision::Where('uId', '=', $ubid)->get();
            $conta = count($rev);
            $conti = 0;
            foreach ($rev as $rv) {
                if (in_array($rv->rEstRev, [1, 2, 3]))
                    $conti++;
                if ($rv->rEstRev === 3)
                    $conobs++;
            }
            if ($conta <= $conti) {
                $ubi = reUbicacion::findOrFail($ubid);
                ($conobs > 0) ? $ubi->fRevEst = 2 : $ubi->fRevEst = 1;
                $ubi->fFecRevi = UtilController::fecha();
                $ubi->save();
                $cond = 1;
            }
            if ($cond === 0) return response()->json(array('error' => 0, 'id' => $request->rid));
            else return response()->json(array('error' => 1));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), 'ReRevisionController', 'store');
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\reRevision $reRevision
     * @return \Illuminate\Http\Response
     */
    public function show(reRevision $reRevision)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\reRevision $reRevision
     * @return \Illuminate\Http\Response
     */
    public function edit(reRevision $reRevision)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\reRevision $reRevision
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, reRevision $reRevision)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\reRevision $reRevision
     * @return \Illuminate\Http\Response
     */
    public function destroy(reRevision $reRevision)
    {
        //
    }

    public function updateCheckListRef($id, $rid)
    {
        try {
            $viat = new ViViatico();
            $res = $viat->getCantViatiIdR($rid);
            if ($res->cant > 0) {
                $cond = 0;
                $rev = reRevision::findOrFail($id);
                $rev->rEstRev = 1;
                $rev->rEstFecRev = UtilController::fecha();
                $rev->save();
                $ubid = $rev->uId;
                $rev = reRevision::Where('uId', '=', $ubid)->get();
                $conta = count($rev);
                $conti = 0;
                foreach ($rev as $rv) {
                    if ($rv->rEstRev === 1)
                        $conti++;
                }
                if ($conta <= $conti) {
                    $ubi = reUbicacion::findOrFail($ubid);
                    $ubi->fRevEst = 1;
                    $ubi->fFecRevi = UtilController::fecha();
                    $ubi->save();
                    $cond = 1;
                }
                if ($cond === 0) return response()->json(array('error' => 0));
                else return response()->json(array('error' => 1));
            } else
                return response()->json(array('error' => 2));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), 'ReRevisionController', 'updateCheckListRef');
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    public function updateCheckListRefer($id)
    {
        try {
            $cond = 0;
            $conobs = 0;
            $rev = reRevision::findOrFail($id);
            //  ($rev->rEstRev === 1) ? $rev->rEstRev = 0 : $rev->rEstRev = 1;
            $rev->rEstRev = 2;
            $rev->rEstFecRev = UtilController::fecha();
            $rev->save();
            $ubid = $rev->uId;
            $rev = reRevision::Where('uId', '=', $ubid)->get();
            $conta = count($rev);
            $conti = 0;
            foreach ($rev as $rv) {
                if (in_array($rv->rEstRev, [1, 2, 3]))
                    $conti++;
                if ($rv->rEstRev === 3)
                    $conobs++;
            }
            if ($conta <= $conti) {
                $ubi = reUbicacion::findOrFail($ubid);
                ($conobs > 0) ? $ubi->fRevEst = 2 : $ubi->fRevEst = 1;
                $ubi->fFecRevi = UtilController::fecha();
                $ubi->save();
                $cond = 1;
            }
            if ($cond === 0) return response()->json(array('error' => 0));
            else return response()->json(array('error' => 1));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), 'ReRevisionController', 'updateCheckListRefer');
            return response()->json(array('error' => $e->getMessage()));
        }
    }

}
