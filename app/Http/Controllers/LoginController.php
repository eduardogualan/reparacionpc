<?php

namespace reparacionpc\Http\Controllers;
//use reparacionpc\Http\Controllers\Auth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
Use Symfony\Component\HttpFoundation\Session\Session;
//use reparacionpc\Http\Requests;

class LoginController extends Controller
{
    public function index() {
        return bcrypt('1105675522');
    }
    public function store(Request $request) {
        if(Auth::attempt(['usuario'=>$request['cedula'], 'password'=>$request['password']])){
          return  Redirect::to('home');
        }
        return  Redirect::to('/')->with('mensajeError', 'Datos Incorrectos');
    }
    
    public function salir() {
        Auth::logout();
        return Redirect::to('/');
    }
}
