<?php

namespace reparacionpc\Http\Controllers;

use Illuminate\Http\Request;
use reparacionpc\Http\Requests;
use reparacionpc\Equipo;
use \Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use reparacionpc\User;

class EquipoController extends Controller {

    private $equipo = null;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $datos['titulo'] = 'ADMINISTRAR EQUIPOS';
            return view('template.equipo.listar', $datos);
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create() {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $datos['titulo'] = 'ADMINISTRAR EQUIPO';
            return view('template.equipo.create', $datos);
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response  rrhh@compumicro
     */
    public function store() {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $nombre = $_POST['nombre'];
            $this->cargarObjeto();
            if ($this->getEquipo()->ObtenerEquipoXnombre($nombre) != null) {
                return redirect('/equipo/create')->with('mensajeError', 'Ya existe un registro con este nombre ' . $nombre);
            } else if ($this->getEquipo()->save() == false) {
                return redirect('/equipo/create')->with('mensajeError', 'No se pudo Guardar el Registro');
            } else {
                $this->nuevaInstancia();
                return redirect('/equipo')->with('mensajeOK', 'Registro Guardado');
            }
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id) {
        //
        return "Se muestra Fabricante con id: $id";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $this->FijaraInstancia($this->getEquipo()->find($id));
            $datos['titulo'] = 'ADMINISTRAR EQUIPO';
            $datos['equipo'] = $this->getEquipo();
            return view('template.equipo.edit', $datos);
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update($id) {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $this->FijaraInstancia($this->getEquipo()->find($id));
            $this->cargarObjeto();
            if ($this->getEquipo()->save() == true) {
                $this->nuevaInstancia();
                return redirect('/equipo')->with('mensajeOK', 'Registro Modificado');
            } else {
                return redirect('/equipo/' . $id . '/edit')->with('mensajeError', 'No se pudo Modificar el Registro');
            }
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
//        $this->fijarInstancia($this->getMarca()->find($id));
//        return $id;
    }

    public function getEquipo() {
        if ($this->equipo == null) {
            $this->equipo = new Equipo();
        }
        return $this->equipo;
    }

    public function nuevaInstancia() {
        $this->equipo = null;
    }

    public function FijaraInstancia($equipo) {
        $this->equipo = $equipo;
    }
    
    private function cargarObjeto() {
        $this->getEquipo()->nombre_equipo = Input::get('nombre');
    }
    
    public function Buscar() {
        return response()->json($this->getEquipo()->ListarEquipo(Input::get('valor')));
    }

}
