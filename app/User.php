<?php

namespace reparacionpc;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class User extends Authenticatable {

    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = ['usuario', 'estado', 'password'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function persona() {
        return $this->belongsTo('\reparacionpc\Persona');
    }

    public function nombredeusuario($user) {
        $persona = DB::table('persona')->where('cedula', $user)->get();
        foreach ($persona as $item) {
            return $item->nombres . ' ' . $item->apellidos;
        }
    }

    public static function ObtenerRol($cedula) {
        $rol = DB::table('persona')->join("rol", "persona.rol_id", "=", "rol.id")
                ->where('persona.cedula', '=', $cedula)
                ->get();
        foreach ($rol as $item) {
            return $item->nombre_rol;
        }
    }

    public function ListarUsuarios($valor) {
        return DB::table('users')
                        ->join('persona', 'users.persona_id', '=', 'persona.id')
                        ->leftJoin('rol', function($join) {
                            $join->on('persona.rol_id', '=', 'rol.id');
                        })
                        ->select('persona.*', 'users.estado','rol.nombre_rol')
                        ->where('persona.cedula', 'like', "%$valor%")
                        ->orWhere('persona.apellidos', 'like', "%$valor%")
                        ->orderby('persona.apellidos')
                        ->get();
    }
    
    public static function ListarTecnicos() {
        return DB::table('persona')
                        ->join('rol','persona.rol_id', '=', 'rol.id')
                         ->select('persona.cedula','persona.apellidos','persona.nombres','rol.nombre_rol')
                        ->where('rol.nombre_rol', '=', "Tecnico")
                        ->orderby('persona.apellidos')
                        ->get();
    }

}
