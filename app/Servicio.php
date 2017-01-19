<?php

namespace reparacionpc;

use Illuminate\Database\Eloquent\Model;
use reparacionpc\Orden;
use Illuminate\Support\Facades\DB;
class Servicio extends Model
{
    protected $table ='servicio';
    protected $primaryKey ='id';
   // protected $primarykey ='idServicio';
    public $timestamps = false;
    protected $fillable = ['nombre_servicio'];
    
    public function ordenes() {
        return $this->hasMany('\reparacionpc\Orden');
    }
    
    public static function ListarServicios($valor) {
        return DB::table('servicio')
                        ->where('nombre_servicio', 'like', "%$valor%")
                        ->orderby('nombre_servicio')
                        ->get();
    }

    public static function ObtenerServicioXnombre($nombre) {
        $lista = DB::table('servicio')->where('nombre_servicio', $nombre)->get();
            foreach ($lista as $buscarnombre) {
                return $buscarnombre->nombre_servicio;
            }
    }
}
