<?php

namespace App\Http\Controllers\Balance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Registro;
use App\Cuenta;
use DateTime;
use Illuminate\Support\Facades\DB;

class BalanceController extends Controller
{
    //COMPROBACION
    public function balance_comprobacion($id){
    	 $meses = array('enero','febrero','marzo','abril','mayo','junio','julio', 'agosto','septiembre','octubre','noviembre','diciembre');
        $resultados = array();
        $cuentaInfo = Cuenta::All();
        $debeF=0; $haberF=0;
        foreach ($cuentaInfo as $x => $c) {
        	$debe =0;
          $haber = 0;

        	if($id == 'actual'){
             $cuenta = Cuenta::cuenta_T_actual($c->id);
             for ($i=0; $i <count($meses) ; $i++) { 
             	if(date('m')-1 == $i){
             		$fecha = 'BALANCE DE COMPROBACIóN DEL 01 DE '. strtoupper($meses[$i])  .' AL '.$this->ultimo_dia_().' DE '.strtoupper($meses[$i]).' DE '. date('Y');
             	}
             }
        	}
            else{
              //otro proceso
            	$fechaX = substr($id, 0,7);
            	$cuenta = Cuenta::cuenta_T_otro( $c->id,$fechaX);
            	for ($i=0; $i <count($meses) ; $i++) { 
            		if((substr($id, 5,2)-1) == $i){
             		$fecha = 'BALANCE DE COMPROBACIóN DEL 01 DE '. strtoupper($meses[$i])  .' AL '.$this->ultimo_dia_($id).' DE '.strtoupper($meses[$i]).' DE '. substr($id, 0,4);
             	    }
            	}
            }

	        foreach ($cuenta as $key => $value) {
	          if($value->debe =="DEBE"){
	            $debe=$debe+$value->monto;
	          }
	          elseif ($value->haber =="HABER"){
	            $haber =$haber+$value->monto; 
	          }
	        }

	        //mayorizacion
	        $resultados[$x]['nombre'] = $c->nombre;
	        $resultados[$x]['codigo'] = $c->codigo;
	        if ($debe > $haber){
	        	$mayorizacion =  $debe - $haber;
                $resultados[$x]['haber'] = '$ 0.00';
                $resultados[$x]['debe'] = $this->Dolar($mayorizacion);
                $debeF+=$mayorizacion;
	        } 
	        else if($debe < $haber){
	        	$mayorizacion =  $haber - $debe;
	        	$resultados[$x]['haber'] = $this->Dolar($mayorizacion);
                $resultados[$x]['debe'] = '$ 0.00';
                $haberF+=$mayorizacion;
	        } 
	        else{
	        	$resultados[$x]['haber'] = '$ 0.00';
                $resultados[$x]['debe'] = '$ 0.00';
	        } 
        }

          $debeF = $this->Dolar($debeF); 
	      $haberF=$this->Dolar($haberF);

      return view('Balances.BalanceComprobacion',compact('resultados','haberF','debeF','fecha'));
    }
   
    //metodo auxiliar para el balance de comprobacion
    public function cuenta_otro_balance_comp(Request $request){
      $fecha = $request->fecha;
      return redirect()->route('balanceComprobacion', $fecha);
    }


   public  function Dolar($value) {
		  return '$ ' . number_format($value, 2);
   }

   public function Porcentaje($value){
     return ' % '.number_format(($value * 100), 2);
   }
   
   //ultimo dia del mes actual.
   public function ultimo_dia_($fecha = null){
   	       if($fecha ==null){
   	       	 $fecha = new DateTime();
			 $fecha->modify('last day of this month');
   	       }else{
   	       	 $fecha = new DateTime($fecha);
			 $fecha->modify('last day of this month');
   	       }
          	
			 return $fecha->format('d');
   }
   //COMPROBACION


   //ESTADO DE RESULTADOS
   public function estado_resultado($id){
   // $datos = array('VENTA','DESCUENTO DE VENTA','MANO DE OBRA','MATERIA PRIMA','GASTOS ADMINISTRATIVOS','GASTOS DE VENTA');
       $venta_de_vienes = $this->obtener_resultado('VENTA DE VIENES', $id);
       $rebajas_y_devoluciones = $this->obtener_resultado('REBAJAS Y DEVOLUCIONES EN VENTA DE VIENES', $id);
       $ventas_netas = $venta_de_vienes - $rebajas_y_devoluciones;

       $costo_de_venta = $this->obtener_resultado('COSTO DE VENTA', $id);
       $utilidad_bruta = $ventas_netas - $costo_de_venta;

       $gastos_de_operacion = $this->obtener_resultado('GASTOS DE OPERACION', $id);
       $utilidad_de_operacion = $utilidad_bruta - $gastos_de_operacion;

       $gastos_no_operacionales = $this->obtener_resultado('GASTOS NO OPERACIONALES', $id);
       $utilidad_antes_impuestos_reserva = $utilidad_de_operacion - $gastos_no_operacionales;
       $porcentaje_reserva = $this->reserva_legal();

       $reserva_legal = $utilidad_antes_impuestos_reserva* $porcentaje_reserva;
       $utilidad_antes_de_impuesto_renta = $utilidad_antes_impuestos_reserva-$reserva_legal;

       $porcentaje_renta = $this->renta();
       $gastos_de_impuesto_renta = $utilidad_antes_de_impuesto_renta * $porcentaje_renta;

       $utilidadNeta = $utilidad_antes_de_impuesto_renta - $gastos_de_impuesto_renta;
       

       $datos = array(
                         'VENTA DE VIENES' => $this->Dolar($venta_de_vienes),
                         'REBAJAS Y DEVOLUCIONES EN VENTA DE VIENES' => $this->Dolar($rebajas_y_devoluciones),
                         'VENTAS NETAS'=> $this->Dolar($ventas_netas),
                         'COSTO DE VENTA'=> $this->Dolar($costo_de_venta),
                         'UTILIDAD BRUTA'=> $this->Dolar($utilidad_bruta),
                         'GASTOS DE OPERACION'=> $this->Dolar($gastos_de_operacion),
                         'UTILIDAD DE OPERACION'=> $this->Dolar($utilidad_de_operacion),
                         'GASTOS NO OPERACIONALES'=> $this->Dolar($gastos_no_operacionales),
                         'UTILIDAD ANTES IMPUESTO Y RESERVA'=> $this->Dolar($utilidad_antes_impuestos_reserva),
                         'PORCENTAJE RESERVA'=> $this->Porcentaje($porcentaje_reserva),
                         'RESERVA LEGAL'=> $this->Dolar($reserva_legal),
                         'UTILIDAD ANTES DE IMPUESTO RENTA'=> $this->Dolar($utilidad_antes_de_impuesto_renta),
                         'PORCENTAJE RENTA'=> $this->Porcentaje($porcentaje_renta),
                         'GASTOS DE IMPUESTO RENTA'=> $this->Dolar($gastos_de_impuesto_renta),
                         'UTILIDAD NETA'=> $this->Dolar($utilidadNeta),

                      );
       
       $meses = array('enero','febrero','marzo','abril','mayo','junio','julio', 'agosto','septiembre','octubre','noviembre','diciembre');
       $fecha ="";
      if($id == 'actual'){
             for ($i=0; $i <count($meses) ; $i++) { 
              if(date('m')-1 == $i){
                $fecha = 'DEL 01 DE '. strtoupper($meses[$i])  .' AL '.$this->ultimo_dia_().' DE '.strtoupper($meses[$i]).' DE '. date('Y');
              }
             }
        }
            else{
              //otro proceso
              $fechaX = substr($id, 0,7);
              for ($i=0; $i <count($meses) ; $i++) { 
                if((substr($id, 5,2)-1) == $i){
                $fecha = 'DEL 01 DE '. strtoupper($meses[$i])  .' AL '.$this->ultimo_dia_($id).' DE '.strtoupper($meses[$i]).' DE '. substr($id, 0,4);
                  }
              }
          }

       return view('Balances.EstadoResultado', compact('datos','fecha'));
   }


  public function obtener_resultado($estado, $fecha){
    $registrosConfig = DB::table('resultado_config')->where('tipo' , $estado)->get();

    $resultado = 0;
    $registrosXcuenta =  array();
    $haber =0; $debe=0;
    $total = 0;
    if(count($registrosConfig) > 0 ){
        foreach ($registrosConfig as $key => $value) {
          $registrosXcuenta[$key] = Cuenta::mayor_($value->cuenta_id, $fecha);
              foreach ($registrosXcuenta[$key] as $key2 => $value2) {
                 if($value2->haber != '')  $haber += $value2->monto;
                 else $debe += $value2->monto;
               }  
        }
        //echo "haber " . $haber. " debe ". $debe. "<br>";
        //mayor
        if($haber > $debe)$total = $haber - $debe;
        else if($debe > $haber)$total = $debe - $haber;
        else $total = 0;

        //echo $total."<br>";

    }
    return $total;
  }


  //metodo auxiliar para el balance de comprobacion
    public function cuenta_otro_estado_resultado(Request $request){

      $fecha= substr($request->fecha, 0,7);
      return redirect()->route('estadoResultado', $fecha);
    }

    public function reserva_legal(){
      return 0.07;
    }

    public function renta(){
      return 0.25;
    }

}
