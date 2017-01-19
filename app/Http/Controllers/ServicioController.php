<?php

namespace reparacionpc\Http\Controllers;

use Illuminate\Http\Request;
use reparacionpc\Http\Requests;
use reparacionpc\Servicio;
use \Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use reparacionpc\User;

class ServicioController extends Controller {

    private $servicio = null;

    public function index() {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $datos['titulo'] = 'ADMINISTRAR SERVICIOS';
            return view('template.servicio.listar', $datos);
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    public function create() {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $datos['titulo'] = 'ADMINISTRAR SERVICIOS';
            return view('template.servicio.create', $datos);
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    public function store() {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $nombre = $_POST['nombre'];
            $this->cargarObjeto();
            if ($this->getServicio()->ObtenerServicioXnombre($nombre) != null) {
                return redirect('/servicio/create')->with('mensajeError', 'Ya existe un registro con este nombre ' . $nombre);
            } else if ($this->getServicio()->save() == false) {
                return redirect('/servicio/create')->with('mensajeError', 'No se pudo Guardar el Registro');
            } else {
                $this->nuevaInstancia();
                return redirect('/servicio')->with('mensajeOK', 'Registro Guardado');
            }
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    public function show($id) {
        
    }

    public function edit($id) {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $this->fijarInstancia($this->getServicio()->find($id));
            $datos['titulo'] = 'ADMINISTRAR SERVICIOS';
            $datos['servicio'] = $this->getServicio();
            return view('template.servicio.edit', $datos);
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    public function update($id) {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $this->fijarInstancia($this->getServicio()->find($id));
            $this->cargarObjeto();
            if ($this->getServicio()->save() == true) {
                $this->nuevaInstancia();
                return redirect('/servicio')->with('mensajeOK', 'Registro Modificado');
            } else {
                return redirect('/servicio/' . $id . '/edit')->with('mensajeError', 'No se pudo Modificar el Registro');
            }
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    public function destroy($id) {
        
    }

    public function getServicio() {
        if ($this->servicio == null) {
            $this->servicio = new Servicio();
        }
        return $this->servicio;
    }

    public function nuevaInstancia() {
        $this->servicio = null;
    }

    public function fijarInstancia($servicio) {
        $this->servicio = $servicio;
    }

    public function cargarObjeto() {
        $this->getServicio()->nombre_servicio = Input::get('nombre');
    }

    public function Buscar() {
        return response()->json($this->getServicio()->ListarServicios(Input::get('valor')));
    }

}
