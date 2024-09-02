<?php

namespace App\Http\Controllers;

use App\CentropobladoDistrito;
use App\Cliente;
use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        try {
            $vi = 1;
            return view('intranet.mantenimiento.agregarcliente')->with(array('vi' => $vi));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "ClienteController", "index");
            return response(array('error' => $e->getMessage()));
        }
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
                    if($request->sit==1){
                            $person = New Persona();
                            $person->idDt = $request->iddist;
                            if($request->tipdoc==1){
                                $person->peAPPaterno = $request->appaterno;
                                $person->peAPMaterno = $request->apmaterno;
                                $person->peNombres = $request->nombres;
                                $person->peFecNac = date('Y-m-d', strtotime($request->fecnac));

                            }else{
                                if($request->tipdoc==3){
                                    $person->peNombres = $request->razons;
                                }
                            }

                            $person->peNumeroDoc = $request->dni;
                            $person->idTD = $request->tipdoc;
                            $person->peDireccion = $request->dir;
                            $person->peUsuReg = Auth::user()->id;
                            $person->peUsuActuali = Auth::user()->id;
                            $person->peFecCreacion = UtilController::fecha();
                            $person->peFecActualiza = UtilController::fecha();
                            $person->peTelefono = $request->telefo;
                            $person->save();
                            $idpersona= $person->peId;

                            $clien = new Cliente();
                            $clien->idPe =$idpersona;
                            $clien->clUsuReg = Auth::user()->id;
                            $clien->clFecCrea = UtilController::fecha();
                            $clien->save();
                    }else{
                        $clien = new Cliente();
                        $clien->idPe =$request->idpers;
                        $clien->clUsuReg = Auth::user()->id;
                        $clien->clFecCrea = UtilController::fecha();
                        $clien->save();

                    }

            });
            return response()->json(array('error' => 0));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ClienteController","store");
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
                        $person=Persona::findOrfail($request->idpers);
                        $person->idDt = $request->iddist;
                        if($request->tipdoc==1){
                            $person->peAPPaterno = $request->appaterno;
                            $person->peAPMaterno = $request->apmaterno;
                            $person->peNombres = $request->nombres;
                            $person->peFecNac = date('Y-m-d', strtotime($request->fecnac));
                        }else{
                            if($request->tipdoc==1){
                                $person->peNombres = $request->razons;
                            }
                        }
                        $person->peNumeroDoc = $request->dni;
                        $person->idTD = $request->tipdoc;
                        $person->peDireccion = $request->dir;
                        $person->peFecActualiza = UtilController::fecha();;
                        $person->peUsuActuali = Auth::user()->id;
                        $person->peTelefono = $request->telefo;
                        $person->save();

                        $clien=Cliente::findOrfail($request->idclient);
                        $clien->idPe =$request->idpers;
                        $clien->clUsuReg = Auth::user()->id;
                        $clien->clFecActualiza = UtilController::fecha();
                        $clien->save();


            });
            return response()->json(array('error' => 0));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"ClienteController","update");
            return response()->json(array('error' => $e->getMessage()));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            DB::transaction(function () use ($id) {
                $clien=Cliente::findOrfail($id);

                ($clien->clEst === 1) ? $clien->clEst = 0 : $clien->clEst = 1;
                $clien->clFecCrea = UtilController::fecha();
                $clien->save();
            });
            return response()->json(array('error' => 0));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"RePacienteController","destroy");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    function getClienteDni($dni)
    {

        try {
            $client= Cliente::getClienteDni($dni);
            $person = Persona::buscarPersonaDni($dni);
            return response()->json(array('error' => 0,'person'=>$person,'cliente'=>$client));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"Cliente","getClienteDni");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function getClientes(){
        try{
            Return datatables(Cliente::getClientes())->make(true);
        } catch (\Exception $e) {
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function obtenerCliente(Request $request)
    {
        $term = $request->input('term');
        return Cliente::obtenerCliente($term);
    }
    public function getApiDni($tipdoc,$ndoc){
         //dd($tipdoc);
        // Datos
        $token = 'apis-token-8102.T8eOCgVKnAqbnBGu7--AaatEblvmWHVG';

        // Iniciar llamada a API
        $curl = curl_init();

        if($tipdoc==="1"){
            // Buscar dni
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://api.apis.net.pe/v2/reniec/dni?numero=' . $ndoc,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_SSL_VERIFYPEER => 0,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 2,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_CUSTOMREQUEST => 'GET',
                CURLOPT_HTTPHEADER => array(
                    'Referer: https://apis.net.pe/consulta-dni-api',
                    'Authorization: Bearer ' . $token
                ),
            ));
        }else{
            if($tipdoc==="3"){
                // Buscar ruc sunat
                curl_setopt_array($curl, array(
                    CURLOPT_URL => 'https://api.apis.net.pe/v2/sunat/ruc?numero=' . $ndoc,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_ENCODING => '',
                    CURLOPT_MAXREDIRS => 10,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_FOLLOWLOCATION => true,
                    CURLOPT_CUSTOMREQUEST => 'GET',
                    CURLOPT_HTTPHEADER => array(
                        'Referer: http://apis.net.pe/api-ruc',
                        'Authorization: Bearer ' . $token
                    ),
                ));
            }

        }
        $response = curl_exec($curl);

        curl_close($curl);

        // Datos listos para usar
        $persona = json_decode($response);
        //var_dump($persona);
        return response()->json(array('error' => 0,'apicliente'=>$persona));

    }
}
