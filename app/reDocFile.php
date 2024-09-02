<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class reDocFile extends Model
{
    protected $table = 're_doc_file';
    public $primaryKey = 'dFId';
    public $timestamps = false;

    public function getEstFile($rdi)
    {
        /*return DB::table('re_revision  as r')->select('*','r.rId as revid')
            ->join('re_doc_file as rd', 'rd.dFId', '=', 'r.dFId')
            ->leftJoin('vi_viatico as vi','vi.dFId','=','rd.dFId')
            ->where('r.uId', function ($q2) use ($rdi) {
                $q2->from('re_ubicacion as u')->select('u.uId')->where('u.rId', '=', $rdi)
                    ->orderBy('u.uFecCrea', 'desc')
                    ->limit(1);
            })->get();*/
        return DB::table('re_revision  as r')->select('doc.nrOrden','vi.vId','r.rId as revid','rd.dFDescripcion','rd.dFEst','rd.dFEstDoc','rd.dFFecCrea',
        'rd.dFId','rd.dFUbicacion','rd.dFUsuReg','rd.dId','vi.pId','r.rEst',
        'r.rEstFecRev','r.rEstRev','r.rFecCrea','rd.rId','r.rUsuReg',
        'vi.vEst','vi.vFecCrea','vi.vFecMod','vi.vUsu','vi.vUsuMod','cp.vId as cod')
            ->join('re_doc_file as rd', 'rd.dFId', '=', 'r.dFId')
            ->join('re_documento as doc', 'rd.dId', '=', 'doc.dId')
            ->leftJoin('vi_viatico as vi','vi.dFId','=','rd.dFId')
            ->leftJoin('vi_comprobantes as cp','vi.vId','=','cp.vId')
            ->where('r.uId', function ($q2) use ($rdi) {
                $q2->from('re_ubicacion as u')->select('u.uId')->where('u.rId', '=', $rdi)
                    ->orderBy('u.uFecCrea', 'desc')
                    ->limit(1);
            })->groupBy('vi.vId','r.rId','rd.dFDescripcion','rd.dFEst','rd.dFEstDoc','rd.dFFecCrea',
                'rd.dFId','rd.dFUbicacion','rd.dFUsuReg','rd.dId','vi.pId','r.rEst',
                'r.rEstFecRev','r.rEstRev','r.rFecCrea','rd.rId','r.rUsuReg',
                'vi.vEst','vi.vFecCrea','vi.vFecMod','vi.vUsu','vi.vUsuMod','cp.vId','doc.nrOrden')
            ->orderBy('doc.nrOrden' ,'asc')
            ->get();
    }

}
