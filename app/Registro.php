<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registro extends Model
{
    protected $fillable = [
        'id', 'fecha', 'cuenta_id','monto' ,'descripcion','estado',
    ];



    public static function registrar_($fecha, $cuenta,$monto, $des){
    	$registro = Registro::create([
          'fecha'=> $fecha,
          'cuenta_id'=> $cuenta,
          'monto' => $monto,
          'descripcion' => $des,
          'estado' => 'actual'
    	]);
    	return $registro;
    }

}
