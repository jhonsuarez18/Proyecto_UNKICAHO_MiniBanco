<?php

namespace App;

use App\Http\Controllers\UtilController;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EPPedido extends Model
{
    protected $table = 'e_p_pedido';
    public $primaryKey = 'peId';
    public $timestamps = false;
     public function actMontPed(){
         $tabPed=DB::table('e_p_pedido')->where('peMonto','<=',0)->get();
         foreach ($tabPed as $tabp)
         {
             $tabDet=DB::table('e_p_detalle_pedido')->where('peId', $tabp->peId)->get();
             $sum=0;
                foreach ($tabDet as $det){
                    $sum+=$det->VALOR_TOTAL;
                }
             $epped=EPPedido::findOrfail($tabp->peId);
             $epped->peMonto=$sum;
             $epped->peFecAcSig=UtilController::fecha();
             $epped->save();
         }
         return true;
     }

    public static function obtenerPedidos()
    {
        $arr = [1, 2, 3, 4, 6, 16,17];

        if (in_array(Auth::user()->id, $arr)) {
            return $query = DB::table('e_p_pedido as p')
                ->select('p.peId', 'p.peCodPed', 'p.trId as pre', 'p.peFecPre', 'us.name', 'p.peMonto', 'p.peDesc', 'p.peEstPed', 'p.peEst',
                    't.tdesc', 'm.mCod', 'e.eGCod','p.peFecAcOc',
                    DB::raw('case
                        when p.peEstPed=0 then "PEDIDO"
                        when p.peEstPed=1 then "CERTIFICADO"
                        when p.peEstPed=2 then "COMPROMETIDO"
                         when p.peEstPed=3 then "DEVENGADO"
                          when p.peEstPed=4 then "GIRADO"
                        end ests
                        ') ,DB::raw('tr.trNumRj as pre'))
                ->join('e_p_meta_epecifica_gasto  as meg', 'p.mEGId', '=', 'meg.mEGId')
                ->leftJoin('e_p_transferencia as tr', 'tr.trId', '=', 'p.trId')
                // ->join('e_p_presupuesto as pr', 'pr.mEGId', '=', 'meg.mEGId')
                ->join('e_p_meta as m', 'meg.mId', '=', 'm.mId')
                ->join('e_p_especifica_gasto as e', 'e.eGId', '=', 'meg.eGId')
                ->join('e_p_tipo as t', 't.tId', '=', 'p.tId')
                ->join('users as us', 'us.id', '=', 'p.peUsuReg')
                ->where(DB::raw('YEAR(p.peFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
                ->orderBy('p.peFecCrea', 'DESC')->get();
        } else {

            return $query = DB::table('e_p_pedido as p')
                ->select('p.peId', 'p.peCodPed', 'p.trId', 'p.peFecPre', 'us.name', 'p.peMonto', 'p.peDesc', 'p.peEstPed', 'p.peEst',
                    't.tdesc', 'm.mCod', 'e.eGCod','p.peFecAcOc',
                    DB::raw('case
                        when p.peEstPed=0 then "PEDIDO"
                        when p.peEstPed=1 then "CERTIFICADO"
                        when p.peEstPed=2 then "COMPROMETIDO"
                         when p.peEstPed=3 then "DEVENGADO"
                          when p.peEstPed=4 then "GIRADO"
                        end ests
                        '),DB::raw('tr.trNumRj as pre'))
                ->join('e_p_meta_epecifica_gasto  as meg', 'p.mEGId', '=', 'meg.mEGId')
                ->leftJoin('e_p_transferencia as tr', 'tr.trId', '=', 'p.trId')
                // ->join('e_p_presupuesto as pr', 'pr.mEGId', '=', 'meg.mEGId')
                ->join('e_p_meta as m', 'meg.mId', '=', 'm.mId')
                ->join('e_p_especifica_gasto as e', 'e.eGId', '=', 'meg.eGId')
                ->join('e_p_tipo as t', 't.tId', '=', 'p.tId')
                ->join('users as us', 'us.id', '=', 'p.peUsuReg')
                ->where('p.peUsuReg', '=', Auth::user()->id)
                ->where(DB::raw('YEAR(p.peFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
                ->orderBy('p.peFecCrea', 'DESC')->get();

        }

    }

    public static  function  getPedidoDetalle($idped){
        return $query = DB::table('e_p_pedido as p')
            ->select('p.peId', 'p.peCodPed', 'p.trId as pre', 'p.peFecPre', 'us.name', 'p.peMonto', 'p.peDesc', 'p.peEstPed', 'p.peEst',
                't.tdesc', 'm.mCod', 'e.eGDesc', DB::raw('tr.trNumRj as pre')
                ,DB::raw('concat(cc.cCCentroCosto,"|",cc.cCAbreviado) as cc')
            )
            ->join('e_p_meta_epecifica_gasto  as meg', 'p.mEGId', '=', 'meg.mEGId')
            ->leftJoin('e_p_transferencia as tr', 'tr.trId', '=', 'p.trId')
            // ->join('e_p_presupuesto as pr', 'pr.mEGId', '=', 'meg.mEGId')
            ->join('e_p_meta as m', 'meg.mId', '=', 'm.mId')
            ->join('e_p_especifica_gasto as e', 'e.eGId', '=', 'meg.eGId')
            ->join('e_p_tipo as t', 't.tId', '=', 'p.tId')
            ->leftJoin('e_p_centro_costo as cc', 'p.cCId', '=', 'cc.cCId')
            ->join('users as us', 'us.id', '=', 'p.peUsuReg')
            ->where('p.peId','=',$idped)
            ->where(DB::raw('YEAR(p.peFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
            ->orderBy('p.peFecCrea', 'DESC')->first();
    }

    public static function obtenerPedidosTrCodp($idesp, $idtr, $est)
    {

        if ($est === '9') {
            return DB::table('e_p_pedido as pe')->select('*')
              /*  ->whereIn('mEGId', function ($query) use ($idesp, $idtr) {
                    $query->select('mEGId')
                        ->from('e_p_presupuesto')
                        ->where('mEGId', $idesp)
                        ->where('trId', $idtr);
                })*/
                  ->leftJoin( 'e_p_centro_costo as cc','cc.cCId','=','pe.cCId')
                ->where(['mEGId'=>$idesp,'trId'=>$idtr,'peEst'=>1])
                ->where(DB::raw('YEAR(pe.peFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
                ->orderBy('pe.peFecCrea','desc')
                ->get();

        } else {
            return DB::table('e_p_pedido as pe')->select('*')
                /*->whereIn('mEGId', function ($query) use ($idesp, $idtr) {
                    $query->select('mEGId')
                        ->from('e_p_presupuesto')
                        ->where('mEGId', $idesp)
                        ->where('trId', $idtr);
                })**/
                ->leftJoin( 'e_p_centro_costo as cc','cc.cCId','=','pe.cCId')
                ->where(['mEGId'=>$idesp,'trId'=>$idtr,'peEst'=>1,'peEstPed'=>$est])
                ->where(DB::raw('YEAR(pe.peFecCrea)') ,'=',DB::raw('YEAR( NOW())'))
                ->orderBy('pe.peFecCrea','desc')
                ->get();
        }
    }
}
