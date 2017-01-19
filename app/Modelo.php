<?php

namespace reparacionpc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Modelo extends Model {

    protected $table = 'modelo';
    protected $primarykey = 'id';
    public $timestamps = false;
    protected $fillable = ['nombre_modelo', 'marca_id'];

    public static function ListarModelos($valor) {
        return DB::table('modelo')
                        ->join("marca", "modelo.marca_id", "=", "marca.id")
                        ->select('modelo.*', 'marca.nombre_marca')
                        ->where('modelo.nombre_modelo', 'like', "%$valor%")
                        ->orWhere('marca.nombre_marca', 'like', "%$valor%")
                        ->orderby('marca.nombre_marca')
                        ->get();
    }

    public static function ObtenerModeloXnombre($nombre) {
        $lista = DB::table('modelo')->where('nombre_modelo', $nombre)->get();
            foreach ($lista as $buscarnombre) {
                return $buscarnombre->nombre_modelo;
            }
    }
    
    public static function ObtenerModeloxMarca($idMarca) {
        return DB::table('modelo')
                ->where('marca_id', $idMarca)
                ->orderby('modelo.nombre_modelo')
                ->get();
    }

    public function marca() {
        return $this->belongsTo('\reparacionpc\Marca');
    }

    public function ordenes() {
        return $this->hasMany('\reparacionpc\Orden');
    }

}
