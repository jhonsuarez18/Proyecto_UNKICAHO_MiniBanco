<?php

namespace App\Http\Controllers;

use App\Alumno;
use App\Cliente;
use App\Persona;
use App\reAfiliado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AlumnoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        try {
            $vi = $id;
            return view('intranet.mantenimiento.agregaralumno')->with(array('vi' => $vi));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(), "AlumnoController", "index");
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
                    $person->idTD = $request->tipdoc;
                    $person->peAPPaterno = $request->appaterno;
                    $person->peAPMaterno = $request->apmaterno;
                    $person->peNombres = $request->nombres;
                    $person->peFecNac = date('Y-m-d', strtotime($request->fecnac));

                    $person->peNumeroDoc = $request->dni;
                    $person->peDireccion = $request->dir;
                    $person->peTelefono = $request->telefo;
                    $person->peUsuReg = Auth::user()->id;
                    $person->peFecCreacion = UtilController::fecha();
                    $person->save();
                    $idpersona= $person->peId;

                    $alumn = New Alumno();
                    $alumn->idGS = $request->grads;
                    $alumn->idPe =$idpersona;
                    $alumn->alUsuReg = Auth::user()->id;
                    $alumn->alFecCreacion = UtilController::fecha();
                    $alumn->save();
                }else{
                    $alumn = New Alumno();
                    $alumn->idGS = $request->grads;
                    $alumn->idPe =$request->idpers;
                    $alumn->alUsuReg = Auth::user()->id;
                    $alumn->alFecCreacion = UtilController::fecha();
                    $alumn->save();

                }


            });
            return response()->json(array('error' => 0));

        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"AlumnoController","store");
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
    public function getAlumnos(){
        try{
            Return datatables(Alumno::getAlumnos())->make(true);
        } catch (\Exception $e) {
            return response()->json(array('error' => $e->getMessage()));
        }
    }
    public function obtenerAlumno(Request $request)
    {
        $term = $request->input('term');
        return Alumno::obtenerAlumno($term);
    }
    function getAlumnoDni($dni)
    {

        try {
            $alumn= Alumno::getAlumnoDni($dni);
            $person = Persona::buscarPersonaDni($dni);
            $afiliado = reAfiliado::getAfiliadoDni($dni);
            //dd($afiliado);
            return response()->json(array('error' => 0,'person'=>$person,'alumno'=>$alumn,'afiliad'=>$afiliado));
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"Alumno","getAlumnoDni");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
