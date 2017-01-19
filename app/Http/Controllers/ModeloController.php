<?php

namespace reparacionpc\Http\Controllers;

use Illuminate\Http\Request;
use reparacionpc\Http\Requests;
use \Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use reparacionpc\User;
use reparacionpc\Marca;
use reparacionpc\Modelo;

class ModeloController extends Controller {

    private $modelo = null;

    public function index() {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $datos['titulo'] = 'ADMINISTRAR MODELOS';
            return view('template.modelo.listar', $datos);
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
            $datos['titulo'] = 'ADMINISTRAR MODELOS';
            $datos['marca'] = Marca::orderby('nombre_marca')->get();
            return view('template.modelo.create', $datos);
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store() {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $nombre = $_POST['nombre'];
            $this->cargarObjeto();
            if ($this->getModelo()->ObtenerModeloXnombre($nombre) != null) {
                return redirect('/modelo/create')->with('mensajeError', 'Ya existe un registro con este nombre ' . $nombre);
            } if ($this->getModelo()->save() == false) {
                return redirect('/modelo/create')->with('mensajeError', 'No se pudo Guardar el Registro');
            } else {
                $this->nuevaIntancia();
                return redirect('/modelo')->with('mensajeOK', 'Registro Guardado');
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
       // return "Se muestra Fabricante con id: $id";
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id) {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $this->fijarInstancia($this->getModelo()->find($id));
            $datos['titulo'] = 'ADMINISTRAR MODELOS';
            $datos['modelo'] = $this->getModelo();
            $datos['marca'] = Marca::orderby('nombre_marca')->get();
            return view('template.modelo.edit', $datos);
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
            $this->fijarInstancia($this->getModelo()->find($id));
            $this->cargarObjeto();
            if ($this->getModelo()->save() == true) {
                $this->nuevaIntancia();
                return redirect('/modelo')->with('mensajeOK', 'Registro Modificado');
            } else {
                return redirect('/modelo/' . $id . '/edit')->with('mensajeError', 'No se pudo Modificar el Registro');
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
        //
    }

    public function getModelo() {
        if ($this->modelo == null) {
            $this->modelo = new Modelo;
        }
        return $this->modelo;
    }

    public function fijarInstancia($modelo) {
        return $this->modelo = $modelo;
    }

    public function nuevaIntancia() {
        $this->modelo = null;
    }

    private function cargarObjeto() {
        $this->getModelo()->nombre_modelo = Input::get('nombre');
        $marca = Marca::find(Input::get('marca'));
        $this->getModelo()->marca()->associate($marca);
    }

    public function Buscar() {
        return response()->json($this->getModelo()->ListarModelos(Input::get('valor')));
    }

}
