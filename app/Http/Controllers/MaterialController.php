<?php

namespace App\Http\Controllers;

use App\ALEncargado;
use App\ALEntrega;
use App\ALEntregaStock;
use App\ALIngreso;
use App\ALLocal;
use App\ALMaterial;
use App\ALRotacion;
use App\ALRotacionStock;
use App\ALStock;
use App\ALTipMat;
use function Composer\Autoload\includeFile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function PHPSTORM_META\elementType;
use Yajra\DataTables\DataTables;
use ZipStream\Exception;

class MaterialController extends Controller
{


    public function getTipMat()
    {
        return ALTipMat::where('tmEst', 1)->get();
    }

    public function getMedDis(Request $request)
    {
        $term = $request->input('term');
        return ALMaterial::getMat($term);
    }

    public function getLocal()
    {
        $user = ALEncargado::where('idUsuario', Auth::user()->id)->first();
        return ALLocal::where('lId', $user->lId)->first();
    }

    public function store(Request $request)
    {
        try{
            DB::transaction(function () use ($request) {
                $mater=New ALMaterial();

                $mater->tmId=$request->destipm;
                $mater->mCodMed=$request->codmate;
                $mater->mMedNom=$request->desmate;
                $mater->mMedCnc=$request->desconcen;
                $mater->mMedPres=$request->despres;
                $mater->mFecCrea = UtilController::fecha();
                $mater->mUsuReg = Auth::user()->id;
                $mater->save();
            });

            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","store");
            return response(array('error'=>$e->getMessage()));
        }

    }
    public function createStock(Request $request)
    {
        try {

            DB::transaction(function () use ($request) {
                $ingreso = new ALIngreso();
                $ingreso->lId = $request->idloc;
                $ingreso->iMotivo = json_decode($request->mot);
                $ingreso->iUsuReg = Auth::user()->id;;
                $ingreso->iEst = 1;
                $ingreso->save();

                for ($i = 0; $i < count($request->cantmat); $i++) {
                    $stock = new ALStock();
                    $stock->iId = $ingreso->iId;
                    $stock->mId = $request->idmat[$i];
                    $stock->sEstEnt = $request->ori;
                    $stock->sCantUni = $request->cantmat[$i];
                    $stock->sUsuReg = Auth::user()->id;
                    $stock->save();
                }

            });
            return response()->json(array('error' => 0));

        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","createStock");
            return response(array('error'=>$e->getMessage()));
        }

    }

    public function getStockLoc()
    {
        try {

            $user = ALEncargado::where('idUsuario', Auth::user()->id)->first();
            //   echo  $user->lId;
            $stock = new ALStock;
            return Datatables::of($stock->getStockLoc($user->lId))->make(true);
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","getStockLoc");
            return response(array('error'=>$e->getMessage()));
        }

    }
    public function edit(Request $request)
    {
        //AGREGADO 18-12-2020
        try{
            DB::transaction(function() use($request){
                $mater=ALMaterial::findOrfail($request->idmate);
                $mater->tmId=$request->destipm;
                $mater->mCodMed=$request->codmate;
                $mater->mMedNom=$request->desmate;
                $mater->mMedCnc=$request->desconcen;
                $mater->mMedPres=$request->despres;
                $mater->mFecCrea = UtilController::fecha();
                $mater->mUsuReg = Auth::user()->id;
                $mater->save();

            });

            return response()->json(array('error'=>0));
        }catch (Exception $e){
            SErrorController::saveerror($e->getMessage(),"MaterialController","edit");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function destroy($id)
    {
        //AGREGADO 17-12-2020
        try {
            DB::transaction(function () use ($id) {
                $mater = ALMaterial::findOrFail($id);
                ($mater->mEst === 1) ? $mater->mEst = 0 : $mater->mEst = 1;
                $mater->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","destroy");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function delStockLoc($sId)
    {
        try {
            DB::transaction(function () use ($sId) {
                $stock = ALStock::findOrFail($sId);
                ($stock->sEst === 1) ? $stock->sEst = 0 : $stock->sEst = 1;
                $stock->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","delStockLoc");
            return response(array('error'=>$e->getMessage()));
        }

    }

    public function getStockEdit($sId)
    {
        try {
            $stock = new ALStock;
            return response()->json(array('error' => 0, 'stock' => $stock->getStockEdit($sId)));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","getStockEdit");
            return response(array('error'=>$e->getMessage()));
        }
    }

    public function editStock(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $stock = ALStock::findOrFail($request->idstock);
                $stock->sCantUni = $request->cantedit;
                $stock->sUsuReg = Auth::user()->id;
                $stock->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","editStock");
            return response(array('error'=>$e->getMessage()));
        }

    }

    public function getStockTrAl()
    {
        try {
            $user = ALEncargado::where('idUsuario', Auth::user()->id)->first();
            $stock = new ALStock;
            return Datatables::of($stock->obtenerStockAlmacenAcumulado($user->lId))->make(true);
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","getStockTrAl");
            return response(array('error'=>$e->getMessage()));
        }
    }

    public function getLocEje($idEje)
    {
        try {
            $result = ALLocal::where('idEjecutora', $idEje)->get();
            return $result;
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","getLocEje");
            return response(array('error'=>$e->getMessage()));
        }
    }

    public function createMoivimiento(Request $request)
    {
        try {
            DB::transaction(function () use ($request) {
                $rotacion = New ALRotacion;
                $rotacion->lId = $request->idal;
                $rotacion->rMotivo = json_decode($request->motr);
                $rotacion->rUsuReg = Auth::user()->id;
                $rotacion->rEst = 1;
                $rotacion->save();
                for ($i = 0; $i < count($request->idmovmat); $i++) {
                    $rot_stock = New ALRotacionStock;
                    $rot_stock->sId = $request->idmovmat[$i];
                    $rot_stock->rId = $rotacion->rId;
                    $rot_stock->rsCantUni = $request->cantmovmat[$i];
                    $rot_stock->rsUsuReg = Auth::user()->id;
                    $rot_stock->save();
                }
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","createMoivimiento");
            return response(array('error'=>$e->getMessage()));
        }
    }

    public function getMovimiento()
    {
        try {
            $user = ALEncargado::where('idUsuario', Auth::user()->id)->first();
            $stock = new ALStock;
            return Datatables::of($stock->getMovimiento($user->lId))->make(true);
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","getMovimiento");
            return response(array('error'=>$e->getMessage()));
        }
    }
    public function getMovimientoNotif()
    {
        try {
            $user = ALEncargado::where('idUsuario', Auth::user()->id)->first();
            $stock = new ALStock;
            $mov=($stock->getMovimiento($user->lId));
            return $mov;
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","getMovimiento");
            return response(array('error'=>$e->getMessage()));
        }
    }

    public function getItmsMovimiento($ir)
    {
        try {
            $stock = new ALStock;
            return Datatables::of($stock->getItmsMovimiento($ir))->make(true);
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","getItmsMovimiento");
            return response(array('error'=>$e->getMessage()));
        }
    }

    public function createRecibir($idrs)
    {
        try {
            $user = ALEncargado::where('idUsuario', Auth::user()->id)->first();
            $stock = new ALStock;


        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","createRecibir");
            return response(array('error'=>$e->getMessage()));
        }
    }

    public function recibiritmstock(Request $request)
    {
        try {
            $user = ALEncargado::where('idUsuario', Auth::user()->id)->first();
            $rot = ALRotacion::where('rId', $request->idro)->first();
            $local = ALLocal::where('lId', $rot->lId)->first();
            DB::transaction(function () use ($request, $user, $local) {
                if (!empty($request->reciItm)) {
                    $ing = new ALIngreso;
                    $ing->lId = $user->lId;
                    $ing->iMotivo = 'Rotacion de stock,' . $local->lNombre;
                    $ing->iUsuReg = Auth::user()->id;
                    $ing->save();
                    for ($i = 0; $i < count($request->reciItm); $i++) {
                        $rstock = ALRotacionStock::where('rsId', $request->reciItm[$i])->first();
                        $rstock->rsEst = 2;
                        $rstock->save();
                        $stock = ALStock::where('sId', $rstock->sId)->first();
                        $nstock = new ALStock();
                        $nstock->mId = $stock->mId;
                        $nstock->iId = $ing->iId;
                        $nstock->sCantUni = $rstock->rsCantUni;
                        $nstock->sEstEnt = 1;
                        $nstock->sUsuReg = Auth::user()->id;
                        $nstock->save();
                    }
                }
                if (!empty($request->rechItm)) {
                    for ($i = 0; $i < count($request->rechItm); $i++) {
                        $rstock = ALRotacionStock::where('rsId', $request->rechItm[$i])->first();
                        $rstock->rsEst = 0;
                        $rstock->save();
                    }
                }
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","recibiritmstock");
            return response(array('error'=>$e->getMessage()));
        }
    }






    public function delEntrega($id)
    {
        try {
            DB::transaction(function () use ($id) {
                $ent = ALEntrega::findOrFail($id);
                if ($ent->eEst === 1) {
                    $ent->eEst = 0;
                    ALEntregaStock::cambiarEstado($ent->eId, 0);
                } else {
                    $ent->eEst = 1;
                    ALEntregaStock::cambiarEstado($ent->eId, 1);
                }
                $ent->save();
            });
            return response()->json(array('error' => 0));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","delEntrega");
            return response(array('error'=>$e->getMessage()));
        }
    }

    public function getRepTot()
    {
        try {
            return Datatables::of(ALStock::getReporteTotal())->make(true);
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","getRepTot");
            return response(array('error'=>$e->getMessage()));
        }
    }


    public function getGraficoMesvsMedicEje($me, $idmed)
    {
        try {
           $result = ALStock::getGraficoMesvsMedicEje($me, $idmed);
            return response()->json(array('error' => 0, 'result' => $result));
        } catch (Exception $e) {
            SErrorController::saveerror($e->getMessage(),"MaterialController","getGraficoMesvsMedicEje");
            return response(array('error'=>$e->getMessage()));
        }
    }

    public function getMaterial()
    {
        return Datatables::of(ALMaterial::getMaterial())->make(true);
    }
    public function getMateEdit($id)
    {
        Return ALMaterial::where('mId','=',$id)->first();
    }
}
