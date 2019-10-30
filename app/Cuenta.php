<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cuenta extends Model
{
    protected $fillable = [
        'id', 'codigo', 'nombre',
    ];

    public static function obtener_cuentas(){
    	return Cuenta::all();
    }


}
