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

class UserController extends Controller {

    private $persona = null;
    private $user = null;

    public function index() {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $datos['titulo'] = 'ADMINISTRAR USUARIOS';
            return view('template.usuario.listar', $datos);
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    public function create() {
       if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $datos['titulo'] = 'ADMINISTRAR USUARIOS';
            $datos['rol'] = Rol::orderby('nombre_rol')->get();
            return view('template.usuario.create', $datos);
        } else {
            Auth::logout();
            return Redirect::to('/');
        }
    }

    public function store() {
        if (Auth::check() && (User::ObtenerRol(Auth::user()->usuario) == 'Administrador')) {
            $cedula = $_POST['cedula'];
            $this->CargarObjetoPersona();
            if ($this->getPersona()->ObtenerPersonaXCedula($cedula) != null) {
                return redirect('/usuario/create')->with('mensajeError', 'Ya esta registrado este usuario con C.I. o Ruc ' . $cedula);
            } if ($this->getPersona()->save() == false) {
                return redirect('/usuario/create')->with('mensajeError', 'No se pudo Guardar el Registro');
            } else {
                $this->CargarObjetoUser();
                $user = $this->getPersona()->find($this->getPersona()->id);
                $this->getUser()->persona()->associate($user);
                $this->getUser()->save();
                return redirect('/usuario')->with('mensajeOK', 'Registro Guardado');
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
            $this->fijarInstancia($this->getPersona()->find($id));
            $datos['titulo'] = 'ADMINISTRAR USUARIOS';
            $datos['persona'] = $this->getPersona();
            $datos['rol'] = Rol::orderby('nombre_rol')->get();
            return view('template.usuario.edit', $datos);
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
                return redirect('/usuario')->with('mensajeOK', 'Registro Modificado');
            } else {
                return redirect('/usuario/' . $id . '/edit')->with('mensajeError', 'No se pudo Modificar el Registro');
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

    public function fijarInstancia($persona) {
        $this->persona = $persona;
    }

    public function CargarObjetoPersona() {
        $this->getPersona()->cedula = Input::get('cedula');
        $this->getPersona()->apellidos = Input::get('apellidos');
        $this->getPersona()->nombres = Input::get('nombres');
        $this->getPersona()->telefono = Input::get('telefono');
        $this->getPersona()->email = Input::get('email');
        $rol = Rol::find(Input::get('rol'));
        $this->getPersona()->rol()->associate($rol);
    }

    public function CargarObjetoUser() {
        $this->getUser()->usuario = Input::get('cedula');
        $this->getUser()->password = bcrypt(Input::get('cedula'));
        $this->getUser()->estado = "Activo";
    }

    public function Buscar() {
        return response()->json($this->getUser()->ListarUsuarios(Input::get('valor')));
    }

}
