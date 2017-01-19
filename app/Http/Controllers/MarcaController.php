<?php

namespace reparacionpc\Http\Controllers;

use Illuminate\Http\Request;
use reparacionpc\Http\Requests;
use reparacionpc\Marca;
use \Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use reparacionpc\User;

class MarcaController extends Controller {

    private $marca = null;

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index() {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $datos['titulo'] = 'ADMINISTRAR MARCAS';
            return view('template.marca.listar', $datos);
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
            $datos['titulo'] = 'ADMINISTRAR MARCAS';
            return view('template.marca.create', $datos);
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
            if ($this->getMarca()->ObtenerMarcaXnombre($nombre) != null) {
                return redirect('/marca/create')->with('mensajeError', 'Ya existe un registro con este nombre ' . $nombre);
            } else if ($this->getMarca()->save() == false) {
                return redirect('/marca/create')->with('mensajeError', 'No se pudo Guardar el Registro');
            } else {
                $this->nuevaIntancia();
                return redirect('/marca')->with('mensajeOK', 'Registro Guardado');
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
            $this->fijarInstancia($this->getMarca()->find($id));
            $datos['titulo'] = 'ADMINISTRAR MARCAS';
            $datos['marca'] = $this->getMarca();
            return view('template.marca.edit', $datos);
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
            $this->fijarInstancia($this->getMarca()->find($id));
            $this->cargarObjeto();
            if ($this->getMarca()->save() == true) {
                $this->nuevaIntancia();
                return redirect('/marca')->with('mensajeOK', 'Registro Modificado');
            } else {
                return redirect('/marca/' . $id . '/edit')->with('mensajeError', 'No se pudo Modificar el Registro');
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
        $this->fijarInstancia($this->getMarca()->find($id));
        return $id;
    }

    public function getMarca() {
        if ($this->marca == null) {
            $this->marca = new Marca();
        }
        return $this->marca;
    }

    public function fijarInstancia($marca) {
        $this->marca = $marca;
    }

    public function nuevaIntancia() {
        $this->marca = null;
    }

    private function cargarObjeto() {
        $this->getMarca()->nombre_marca = Input::get('nombre');
    }

    public function Buscar() {
        return response()->json($this->getMarca()->ListarMarcas(Input::get('valor')));
    }

}
