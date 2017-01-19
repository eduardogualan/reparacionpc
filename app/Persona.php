<?php

namespace reparacionpc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Persona extends Model {

    protected $table = 'persona';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['cedula', 'apellidos', 'nombres', 'telefono', 'direccion', 'email', 'ciudad'];

    public function rol() {
        return $this->belongsTo('\reparacionpc\Rol');
    }

    public function user() {
        return $this->hasOne('\reparacionpc\User');
    }

    public function ordenes() {
        return $this->hasMany('\reparacionpc\Orden');
    }

    public static function ObtenerPersonaXCedula($cedula) {
        $cedula = DB::table('persona')->where('cedula', '=', $cedula)->get();
        foreach ($cedula as $buscarcedula) {
            return $buscarcedula->cedula;
        }
    }

    public static function ObtenerIdXcedula($cedula) {
        $cedula = DB::table('persona')->where('cedula', '=', $cedula)->get();
        foreach ($cedula as $buscarcedula) {
            return $buscarcedula->id;
        }
    }

    public static function ListarClientes($valor) {
//        return DB::table('rol')->join("persona", "rol.id", "=", "persona.rol_id")
//                        ->select('persona.*', 'rol.nombre_rol')
//                        ->where('rol.nombre_rol', '=', 'Administrador')
//                        ->orWhere(function($query) {
//                            $query->where('persona.cedula', 'like', "% %")
//                            ->where('persona.apellidos', 'like', "% %");
//                            // ->where('rol.nombre_rol', '=', 'Administrador');
//                        })
//                        ->orderby('persona.apellidos')
//                        ->get();

        return DB::table('persona')->join("rol", "persona.rol_id", "=", "rol.id")
                        ->select('persona.*', 'rol.nombre_rol')
                        ->orWhere(function($query) {
                            $query->where('rol.nombre_rol', '=', 'Cliente');
                        })
                        ->where('persona.cedula', 'like', "%$valor%")
                        ->orderby('persona.apellidos')
                        ->get();
    }

    public static function CargarClientes($cedula) {
        return DB::table('persona')->where("cedula", $cedula)->get();
    }

}
