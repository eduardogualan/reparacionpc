<?php

namespace reparacionpc\Http\Controllers;

use Illuminate\Http\Request;
use reparacionpc\Http\Requests;
use \Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use reparacionpc\User;
use reparacionpc\Orden;
use reparacionpc\Marca;
use reparacionpc\Servicio;
use reparacionpc\Modelo;

class OrdenController extends Controller {

    private $orden = null;

    public function index() {
        if (!((Auth::check()) || (User::ObtenerRol(Auth::user()->usuario) == 'Administrador') || (User::ObtenerRol(Auth::user()->usuario) == 'Recepcion'))) {
            Auth::logout();
            return Redirect::to('/');
        } else {
            $datos['titulo'] = 'ADMINISTRAR ORDENES';
            return view('template.cliente.orden.listar', $datos);
        }
    }

    public function create() {
        
    }

    public function store() {
        
    }

    public function show($id) {
        
    }

    public function edit($id) {
        if (!((Auth::check()) || (User::ObtenerRol(Auth::user()->usuario) == 'Administrador') || (User::ObtenerRol(Auth::user()->usuario) == 'Recepcion'))) {
            Auth::logout();
            return Redirect::to('/');
        } else {
            $this->fijarInstancia($this->getOrden()->find($id));
            $datos['titulo'] = 'ADMINISTRAR ORDENES';
            $datos['orden'] = $this->getOrden();
            $datos['marca'] = Marca::orderBy('nombre_marca')->get();
            $datos['servicio'] = Servicio::orderBy('nombre_servicio')->get();
            return view('template.cliente.orden.edit', $datos);
        }
    }

    public function update($id) {
        if (!((Auth::check()) || (User::ObtenerRol(Auth::user()->usuario) == 'Administrador') || (User::ObtenerRol(Auth::user()->usuario) == 'Recepcion'))) {
            Auth::logout();
            return Redirect::to('/');
        } else {
            $this->fijarInstancia($this->getOrden()->find($id));
            return $_POST['modelo'];
        }
    }

    public function destroy($id) {
        
    }

    public function getOrden() {
        if ($this->orden == null) {
            $this->orden = new Orden();
        }
        return $this->orden;
    }

    public function fijarInstancia($orden) {
        $this->orden = $orden;
    }

    public function Buscar() {
        return response()->json($this->getOrden()->ListarOrdenes(Input::get('valor')));
    }

}
