<?php

namespace App\Http\Controllers;


use App\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {

        $usuario=Usuario::reportarUsuario(Auth::user()->id);
        session()->put('rol', strtoupper ($usuario->description));
        session()->put('perfil',$usuario->imagen);

       if($request->user()->hasAnyRole(['INTRANET'])){
        return view('intranet.home');}
        else{
           if ( $request->user()->hasAnyRole(['VISITADOR']))
           {
               return view('index');
           }
        }


    }
}
