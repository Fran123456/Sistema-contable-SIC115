<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
class Cuenta extends Model
{
    protected $fillable = [
        'id', 'codigo', 'nombre','tipo',
    ];

    public static function obtener_cuentas(){
    	return Cuenta::all();
    }

    public static function cuenta_T_actual($cuenta){
    	$registros = DB::table('registros')
            ->join('cuentas', 'cuentas.id', '=', 'registros.cuenta_id')
            ->where('estado', 'actual')->where('cuenta_id',$cuenta)
            ->get();
            return $registros;
    }



    public static function cuenta_T_otro($cuenta, $fecha){
            $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.id', '=', 'registros.cuenta_id')
            ->where('estado', $fecha)->where('cuenta_id',$cuenta)
            ->get();
            return $registros;
    }

    public static function cuentaInfo($id){
    	$cuenta = Cuenta::find($id);
    	return $cuenta;
    }

    public static function crear_cuenta($codigo, $nombre, $tipo){
    	$cuenta = Cuenta::create([
            'codigo'=> $codigo,
            'nombre'=> $nombre,
            'tipo' => $tipo,
         ]);

    	return $cuenta;
    }

    public static function mayor_($cuenta, $estado){

        if($estado == 'actual'){
            $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.id', '=', 'registros.cuenta_id')
            ->where('estado', $estado)->where('cuenta_id',$cuenta)->select('registros.monto', 'registros.debe','registros.haber')->get();
        }else{
           $c= substr($estado, -2);
           $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.id', '=', 'registros.cuenta_id')
            ->where('estado', 'like', '%' . $c . '%')->where('cuenta_id',$cuenta)->select('registros.monto', 'registros.debe','registros.haber')->get();
        }

        
        return $registros;

    }



}
