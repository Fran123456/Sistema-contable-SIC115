<?php

namespace App\Http\Controllers\Cuenta;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Cuenta;

class CuentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $cuentas = Cuenta::obtener_cuentas();
        return view('Cuenta.Cuentas', compact('cuentas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cuenta = Cuenta::crear_cuenta($request->codigo, $request->cuenta);
        return redirect('Cuenta')->with('success', 'La cuenta <strong> ' .  $cuenta->nombre . ' </strong> ha sido registrada exitosamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $debe =0;
        $haber = 0;
        $cuenta = Cuenta::cuenta_T_actual($id);
        $cuentaInfo = Cuenta::cuentaInfo($id);
        foreach ($cuenta as $key => $value) {
          if($value->debe =="DEBE"){
            $debe=$debe+$value->monto;
          }
          elseif ($value->haber =="HABER"){
            $haber =$haber+$value->monto; 
          }
        }

        //mayorizacion
        if ($debe > $haber) $mayorizacion =  $debe - $haber;
        else if($debe < $haber) $mayorizacion =  $haber - $debe;
        else $mayorizacion =  0;
        


        return view('Cuenta.Cuenta', compact('debe','haber','cuenta','cuentaInfo','mayorizacion'));
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
