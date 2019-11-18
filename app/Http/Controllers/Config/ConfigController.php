<?php

namespace App\Http\Controllers\Config;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Cuenta;
class ConfigController extends Controller
{

	//REFERENTE A ESTADOS DE RESULTADO
    public function view_config_estado_resultado(){

    	$cuentas =  Cuenta::obtener_cuentas();
        $registros = DB::table('resultado_config')->get();
        $aux =  array();
        $data =  array();
        $controlador = false;
        $cont=0;

        foreach ($cuentas as $key2 => $c) {

             foreach ($registros as $key => $r) 
             {
	             if ($r->cuenta_id == $c->id ) {
	               $controlador=true; 
	               break;
	             }
             }
             if($controlador==false){
             	$data[$cont] = $c;
             	$cont++;
             } 

             $controlador = false;
       }

     
      $registros = DB::table('resultado_config')
            ->join('cuentas', 'cuentas.id', '=', 'resultado_config.cuenta_id')->
            select('resultado_config.*','cuentas.nombre')->get();

   
       return view('Config.estadoResultado', compact('data','registros'));
   }
 

 
    public function crear_(Request $request)
    {
    	DB::table('resultado_config')->insert(
			[
			 'tipo' => $request->tipo,
			 'cuenta_id' => $request->cuenta
			]
		);
        return back()->with('success', 'Registro guardado correctamente');
    }

    public function eliminar_($id){
      DB::table('resultado_config')->where('id', $id)->delete();
      return back()->with('success', 'Elemento eliminado correctamente');
    }
     //REFERENTE A ESTADOS DE RESULTADO
}
