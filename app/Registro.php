<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Cuenta;
use Illuminate\Support\Facades\DB;

class Registro extends Model
{
    protected $fillable = [
        'id', 'fecha', 'cuenta_id','monto' ,'descripcion','estado','debe','haber',
    ];



    public static function registrar_($fecha, $cuenta,$monto, $des, $debeHaber){
      if($debeHaber == 'DEBE'){
          $registro = Registro::create([
            'fecha'=> $fecha,
            'cuenta_id'=> $cuenta,
            'monto' => $monto,
            'descripcion' => $des,
            'estado' => 'actual',
            'debe' => $debeHaber
         ]);
      }else{
        $registro = Registro::create([
            'fecha'=> $fecha,
            'cuenta_id'=> $cuenta,
            'monto' => $monto,
            'descripcion' => $des,
            'estado' => 'actual',
            'haber' => $debeHaber
         ]);
      }
    	return $registro;
    }

    public static function obtener_registros_actuales($id){

      if($id =="actual"){
             $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.id', '=', 'registros.cuenta_id')
            ->where('estado',$id)->orderBy('registros.id','desc')
            ->paginate();
      }
      else{

           if(strlen($id) == 7){
            $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.id', '=', 'registros.cuenta_id')
            ->where('fecha', 'like', '%' . $id . '%')
            ->paginate();
          }else{
            $registros = DB::table('registros')
            ->join('cuentas', 'cuentas.id', '=', 'registros.cuenta_id')
            ->where('fecha',$id)
            ->paginate();
          }
      }

      return $registros;
    } 

    

    public static function actualizar_estados($fecha){
       Registro::where('estado', 'actual')->update(['estado'=> $fecha]);
    }

    public static function verificar_registros_actuales(){
      $da = Registro::where('estado','actual')->get();
      return count($da);
    }

}
