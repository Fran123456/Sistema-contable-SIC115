<?php

namespace App\Http\Controllers\Registro;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cuenta;
use App\Registro;

//Controlador para registrar y manejar los registros contables
class RegistroController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cuentas = Cuenta::obtener_cuentas();
        return view('Registro.Registrar', compact('cuentas'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $re1 = Registro::registrar_($request->fecha, $request->cuentaA, $request->montoA ,$request->desA);
        $re2 = Registro::registrar_($request->fecha, $request->cuentaB, $request->montoB ,$request->desB);

        return redirect('Registro')->with('success', 'El registro se realizo correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {   
        $registros = Registro::obtener_registros_actuales($id);
        $meses = array('enero','febrero','marzo','abril','mayo','junio','julio', 'agosto','septiembre','octubre','noviembre','diciembre');

        if(strlen($id) == 7){
            $c = substr($id, -2);
            for ($i=0; $i <count($meses) ; $i++) { 
                if($c == ($i+1))
                    $mes = "Libro diario de " . $meses[$i]. " del ". substr($id, 0,4);
            }
        }else if($id == "actual"){
            for ($i=0; $i <count($meses); $i++) { 
                 if(date("m") == ($i+1))
                    $mes ='Libro diario de '. $meses[$i] .' del '. date('Y') . ' (ACTUAL)';
            }
        }else{
            $mes = "Libro diario de la fecha: " .$id;
        }

        return view('Registro.RegistrosLista', compact('registros','mes'));

        
    }

    public function registros_fecha(Request $request){
        $fecha = $request->date;
        $control = $request->mes;

        if($control != null){
            $fecha = substr($fecha, 0,7);    // devuelve "f"
        }
        
        return redirect()->route('Registro.show', $fecha);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
