<?php

namespace reparacionpc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Orden extends Model {

    protected $table = 'orden';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $filellable = ['nroOrden', 'fIngreso', 'FSalida', 'observaciones', 'descFalla', 'solucion', 'valor', 'accesorios', 'estado', 'codTecnico'];

    public function modelo() {
        return $this->belongsTo('\reparacionpc\Modelo');
    }

    public function persona() {
        return $this->belongsTo('\reparacionpc\Persona');
    }

    public function servicio() {
        return $this->belongsTo('\reparacionpc\Servicio');
    }

    public function equipo() {
        return $this->belongsTo('\reparacionpc\Equipo');
    }

    public static function ObtenerNumeroDeOrden() {
        return DB::table('orden')->get();
    }

    public static function ObtenerTecnico($cedula) {
        return DB::table('orden')->where('codTecnico', $cedula)->get();
    }

    public static function ListarOrdenes($valor) {
        return DB::table('orden')->join("persona", "orden.persona_id", "=", "persona.id")
                        ->leftJoin('servicio', function($join) {
                            $join->on('orden.servicio_id', '=', 'servicio.id');
                        })
                        ->leftJoin('equipo', function($join) {
                            $join->on('orden.equipo_id', '=', 'equipo.id');
                        })
                        ->leftJoin('modelo', function($join) {
                            $join->on('orden.modelo_id', '=', 'modelo.id');
                        })
                        ->leftJoin('marca', function($join) {
                            $join->on('modelo.marca_id', '=', 'marca.id');
                        })
                        ->select('orden.*', 'persona.apellidos', 'persona.nombres', 'servicio.nombre_servicio', 'modelo.nombre_modelo', 'marca.nombre_marca','equipo.nombre_equipo')
                        ->where('orden.nroOrden', 'like', "%$valor%")
                        ->orWhere('persona.apellidos', 'like', "%$valor%")
                        ->orderby('orden.nroOrden')
                        ->get();
    }
    
    public static function ListarOrdenesXcedula($cedula) {
        return DB::table('orden')->join("persona", "orden.persona_id", "=", "persona.id")
                        ->leftJoin('servicio', function($join) {
                            $join->on('orden.servicio_id', '=', 'servicio.id');
                        })
                        ->leftJoin('equipo', function($join) {
                            $join->on('orden.equipo_id', '=', 'equipo.id');
                        })
                        ->leftJoin('modelo', function($join) {
                            $join->on('orden.modelo_id', '=', 'modelo.id');
                        })
                        ->leftJoin('marca', function($join) {
                            $join->on('modelo.marca_id', '=', 'marca.id');
                        })
                        ->select('orden.*', 'persona.apellidos', 'persona.nombres','persona.cedula', 'servicio.nombre_servicio', 'modelo.nombre_modelo', 'marca.nombre_marca','equipo.nombre_equipo')
                        ->where('persona.cedula', '=', $cedula)
                        ->orderby('orden.nroOrden')
                        ->get();
    }
    
    public static function ListarOrdenesXcodTecnico($codTecnico) {
        return DB::table('orden')->join("persona", "orden.persona_id", "=", "persona.id")
                        ->leftJoin('servicio', function($join) {
                            $join->on('orden.servicio_id', '=', 'servicio.id');
                        })
                        ->leftJoin('equipo', function($join) {
                            $join->on('orden.equipo_id', '=', 'equipo.id');
                        })
                        ->leftJoin('modelo', function($join) {
                            $join->on('orden.modelo_id', '=', 'modelo.id');
                        })
                        ->leftJoin('marca', function($join) {
                            $join->on('modelo.marca_id', '=', 'marca.id');
                        })
                        ->select('orden.*', 'persona.apellidos', 'persona.nombres','persona.cedula', 'servicio.nombre_servicio', 'modelo.nombre_modelo', 'marca.nombre_marca','equipo.nombre_equipo')
                        ->where('orden.codTecnico', '=', $codTecnico)
                        ->orderby('orden.nroOrden')
                        ->get();
    }

}
