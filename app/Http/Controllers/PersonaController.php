<?php

namespace reparacionpc\Http\Controllers;

use Illuminate\Http\Request;
use reparacionpc\Http\Requests;
use \Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use reparacionpc\Rol;
use reparacionpc\Persona;
use reparacionpc\User;
use reparacionpc\Orden;
use reparacionpc\Marca;
use reparacionpc\Modelo;
use reparacionpc\Servicio;
use reparacionpc\Equipo;

//seleccion@bancointernacional.ec
class PersonaController extends Controller {

    private $persona = null;
    private $user = null;
    private $orden = null;

    public function index() {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $datos['titulo'] = 'ADMINISTRAR CLIENTES';
            return view('template.cliente.listar', $datos);
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    public function create() {
        if (!((Auth::check()) || (User::ObtenerRol(Auth::user()->usuario) == 'Administrador') || (User::ObtenerRol(Auth::user()->usuario) == 'Recepcion'))) {
            Auth::logout();
            return Redirect::to('/');
        } else {
            $datos['titulo'] = 'ADMINISTRAR CLIENTES';
            $datos['tecnico'] = $this->getUser()->ListarTecnicos();
            $datos['marca'] = Marca::orderBy('nombre_marca')->get();
            $datos['servicio'] = Servicio::orderBy('nombre_servicio')->get();
            $datos['equipo'] = Equipo::orderBy('nombre_equipo')->get();
            return view('template.cliente.create', $datos);
        }
       
    }

    public function store() {
        if (!((Auth::check()) || (User::ObtenerRol(Auth::user()->usuario) == 'Administrador') || (User::ObtenerRol(Auth::user()->usuario) == 'Recepcion'))) {
            Auth::logout();
            return Redirect::to('/');
        } else {
            if ($this->getPersona()->ObtenerIdXcedula($_POST['cedula']) == null) {
                $this->CargarObjetoPersona();
                if ($this->getPersona()->save() == true) {
                    $persona = $this->getPersona()->find($this->getPersona()->id);
                    $this->CargarObjetoUser();
                    $this->getUser()->persona()->associate($persona);
                    $this->getUser()->save();
                    $this->CargarObjetoOrden();
                    $this->getOrden()->persona()->associate($persona);
                    $this->getOrden()->save();
                    if (User::ObtenerRol(Auth::user()->usuario) == "Administrador") {
                        return redirect('/cliente')->with('mensajeOK', 'Registro Guardado');
                    } else {
                        return redirect('/orden')->with('mensajeOK', 'Registro Guardado');
                    }
                }
            } else {
                $this->CargarObjetoOrden();
                $personaB = $this->getPersona()->find($this->getPersona()->ObtenerIdXcedula($_POST['cedula']));
                $this->getOrden()->persona()->associate($personaB);
                if ($this->getOrden()->save() == true) {
                    $this->getOrden()->save();
                    if (User::ObtenerRol(Auth::user()->usuario) == "Administrador") {
                        return redirect('/cliente')->with('mensajeOK', 'Registro Guardado');
                    } else {
                        return redirect('/orden')->with('mensajeOK', 'Registro Guardado');
                    }
                }
            }
        }
    }

    public function show($id) {
        
    }

    public function edit($id) {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $this->fijarInstancia($this->getPersona()->find($id));
            $datos['titulo'] = 'ADMINISTRAR CLIENTES';
            $datos['persona'] = $this->getPersona();
            return view('template.cliente.edit', $datos);
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    public function update($id) {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $this->fijarInstancia($this->getPersona()->find($id));
            $this->CargarObjetoPersona();
            if ($this->getPersona()->save() == true) {
                return redirect('/cliente')->with('mensajeOK', 'Registro Modificado');
            } else {
                return redirect('/cliente/' . $id . '/edit')->with('mensajeError', 'No se pudo Modificar el Registro');
            }
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    public function destroy($id) {
        
    }

    public function getPersona() {
        if ($this->persona == null) {
            $this->persona = new Persona();
        }
        return $this->persona;
    }

    public function getUser() {
        if ($this->user == null) {
            $this->user = new User();
        }
        return $this->user;
    }

    public function getOrden() {
        if ($this->orden == null) {
            $this->orden = new Orden();
        }

        return $this->orden;
    }

    public function fijarInstancia($persona) {
        $this->persona = $persona;
    }

    public function CargarObjetoPersona() {
        $this->getPersona()->cedula = Input::get('cedula');
        $this->getPersona()->apellidos = Input::get('apellidos');
        $this->getPersona()->nombres = Input::get('nombres');
        $this->getPersona()->telefono = Input::get('telefono');
        $this->getPersona()->email = Input::get('email');
        $this->getPersona()->direccion = Input::get('direccion');
        $this->getPersona()->ciudad = Input::get('ciudad');
        $rol = Rol::find(Rol::ObtenerRolCliente());
        $this->getPersona()->rol()->associate($rol);
    }

    public function CargarObjetoUser() {
        $this->getUser()->usuario = Input::get('cedula');
        $this->getUser()->password = bcrypt($this->NumeroOrden());
        $this->getUser()->estado = "Activo";
    }

    public function CargarObjetoOrden() {
        $this->getOrden()->nroOrden = $this->NumeroOrden();
        $this->getOrden()->FIngreso = date("Y") . '/' . date("m") . "/" . date("d");
        $this->getOrden()->descFalla = Input::get('descfalla');
        $this->getOrden()->observaciones = Input::get('observaciones');
        $this->getOrden()->valor = Input::get('valor');
        $this->getOrden()->estado = "Ingresado";
        $this->getOrden()->codTecnico = Input::get('tecnico');
        $modelo = Modelo::find(Input::get('modelo'));
        $this->getOrden()->modelo()->associate($modelo);
        $servicio = Servicio::find(Input::get('servicio'));
        $this->getOrden()->servicio()->associate($servicio);
        $equipo = Equipo::find(Input::get('equipo'));
        $this->getOrden()->equipo()->associate($equipo);
    }

    public function Buscar() {
        return response()->json($this->getPersona()->ListarClientes(Input::get('valor')));
    }

    public function CargarCliente() {
        return response()->json($this->getPersona()->CargarClientes(Input::get('valor')));
    }

    public function ObtenerModeloXMarca() {
        return response()->json(Modelo::ObtenerModeloxMarca(Input::get('valor')));
    }

    public function Buscarcedula() {
        return $this->getPersona()->ObtenerPersonaXCedula(Input::get('valor'));
    }

    private function NumeroOrden() {
        $ceros = 10;
        $numero = $this->getOrden()->count() + 1;
        return sprintf("%0" . $ceros . "s", $numero);
    }
    
    public function NumerodeMaquinasTecnicos() {
        $tecnico = Orden::where('codTecnico',Input::get('valor'))->get();
        return $tecnico->count();
    }

}
