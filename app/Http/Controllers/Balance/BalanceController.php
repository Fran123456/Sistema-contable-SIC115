<?php

namespace App\Http\Controllers\Balance;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Registro;
use App\Cuenta;
use DateTime;

class BalanceController extends Controller
{
    //COMPROBACION
    public function balance_comprobacion($id){
    	 $meses = array('enero','febrero','marzo','abril','mayo','junio','julio', 'agosto','septiembre','octubre','noviembre','diciembre');
        $resultados = array();
        $cuentaInfo = Cuenta::All();
        $debeF=0; $haberF=0;
        $fecha ="";
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


}
