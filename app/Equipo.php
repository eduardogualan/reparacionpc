<?php

namespace reparacionpc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Equipo extends Model {

    protected $table = 'equipo';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nombre_equipo'];

    public function orden() {
        return $this->hasMany('\reparacionpc\Orden');
    }

    public static function ListarEquipo($valor) {
        return DB::table('equipo')
                        ->where('nombre_equipo', 'like', "%$valor%")
                        ->orderby('nombre_equipo')
                        ->get();
    }

    public static function ObtenerEquipoXnombre($nombre) {
        $lista = DB::table('equipo')->where('nombre_equipo', $nombre)->get();
        foreach ($lista as $buscarnombre) {
            return $buscarnombre->nombre_equipo;
        }
    }

}
