<?php

namespace reparacionpc;

use Illuminate\Database\Eloquent\Model;
Use Illuminate\Support\Facades\DB;

class Rol extends Model
{
    protected  $table ='rol';
    protected  $primarykey='id';
    public $timestamps = false;
    protected $fillable = ['nombre_rol', 'descripcion_rol'];
    
    public function persona() {
        return $this->hasOne('\reparacionpc\Persona');
    }
    
    public static function ObtenerRolCliente() {
        $rol = DB::table('rol')->where('nombre_rol','=','Cliente')->get();
        foreach ($rol as $item){
            return $item->id;
        }
    }
}
