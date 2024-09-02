<?php

namespace App\Http\Controllers;

use App\Persona;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use vakata\database\Exception;

class PersonaController extends Controller
{
    public function validarDni($numeroDni)
    {
        try {
            $result=Persona::validarDni($numeroDni);
            return response()->json(array('error' => 0, 'cant' => $result));
        } catch (Exception $e) {
            return response()->json(array('error' => $e));
        }
    }
    public function getPersonatermino(Request $request)
    {
        try{
            $term = $request->input('term');
            return Persona::obtenerPersonaTermino($term);
        } catch (\Exception $e) {
            SErrorController::saveerror($e->getMessage(),"PersonaController","getPersonatermino");
            return response()->json(array('error' => $e->getMessage()));
        }
    }
}
