<?php

namespace reparacionpc;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Marca extends Model {

    protected $table = 'marca';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nombre_marca'];

    public function modelos() {
        return $this->hasMany('\reparacionpc\Modelo');
    }

    public static function ListarMarcas($valor) {
        return DB::table('marca')
                        ->where('nombre_marca', 'like', "%$valor%")
                        ->orderby('nombre_marca')
                        ->get();
    }

    public static function ObtenerMarcaXnombre($nombre) {
        $lista = DB::table('marca')->where('nombre_marca', $nombre)->get();
            foreach ($lista as $buscarnombre) {
                return $buscarnombre->nombre_marca;
            }
    }

}
