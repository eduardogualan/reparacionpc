<?php

namespace reparacionpc\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use reparacionpc\User;
use reparacionpc\Orden;

class Admin extends BaseController {

    public function Login() {
        return view('template.login');
    }

    public function PaginaPrincipal() {
        if (Auth::check()) {
            $datos['datosMaquina'] = Orden::ListarOrdenesXcedula(Auth::user()->usuario);
            $datos['datosMaquinaTecnico'] = Orden::ListarOrdenesXcodTecnico(Auth::user()->usuario);
            return view('template.principal.index', $datos);
        }else{
            Auth::logout();
            return Redirect::to('/');
        } 
    }

}
