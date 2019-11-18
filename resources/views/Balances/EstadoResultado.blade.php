@extends('layouts.main')

@section('content')

<style type="text/css">
	.red_error{
		color: red;
	}


  .jumbotron {
      padding: 0.4rem 0.4rem;
  }
</style>


 


<div class="container">

<div class="col-sm-12">
<form class="" action="{{ route('cuentaOtroEstadoR') }}" method="get">
    <h5>Balance por fecha (Seleccione cualquier día, se tomara solo el mes y año.)</h5>
            <div class="form-group row">
                    <div class="col-sm-3">
                          <div class="input-group">
                            <span class="input-group-btn">
                             <button type="submit" class="btn btn-primary go-class"><i class="fa fa-search"></i></button>
                             </span>
                            <input required="" type="date" name="fecha" class="form-control">
                          </div>
                    </div>
            </div>
  </form>
</div>




  <div class="row justify-content-md-center">
      <div class="x_panel">
                <div class="x_title">
                  <h2></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content text-center" style="display: block;">

                  <div class="col-md-12">
                    <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron text-center">
                      <h3>Empresa</h3>
                      <h4>ESTADO DE RESULTADO</h4>
                      <p>{{$fecha}}</p>
                    </div>
                  </div>
                  </div>
                  <div class="container">
                    <div class="row">
                      <div  class="col col-lg-2">
      
                  </div>
                  <div class="col-md-auto">
                    <table  id="myTable" class="table">
                      <thead>
                        <tr>
                          <th width="400">-</th>
                          <th width="400">Importe</th>
                        </tr>
                      </thead>
                      <tbody>
                              <tr style="background-color: #EBFAF7">
                                 <td >VENTA DE VIENES</td>
                                 <td>{{$datos['VENTA DE VIENES']}}</td>
                              </tr>

                              <tr style="background-color: #EBFAF7">
                                 <td >REBAJAS Y DEVOLUCIONES EN VENTA DE VIENES</td>
                                 <td>{{$datos['REBAJAS Y DEVOLUCIONES EN VENTA DE VIENES']}}</td>
                              </tr>

                              <tr style="background-color: #C8E5DF">
                                 <td>VENTAS NETAS</td>
                                 <td>{{$datos['VENTAS NETAS']}}</td>
                              </tr>

                              <tr style="background-color: #FCECF4">
                                 <td>COSTO DE VENTA</td>
                                 <td>{{$datos['COSTO DE VENTA']}}</td>
                              </tr>

                              <tr style="background-color: #FCECF4">
                                 <td>UTILIDAD BRUTA</td>
                                 <td>{{$datos['UTILIDAD BRUTA']}}</td>
                              </tr>

                              <tr style="background-color: #FCECF4">
                                 <td>GASTOS DE OPERACIÓN</td>
                                 <td>{{$datos['GASTOS DE OPERACION']}}</td>
                              </tr>

                              <tr style="background-color: #FCECF4">
                                 <td>UTILIDAD DE OPERACIÓN</td>
                                 <td>{{$datos['UTILIDAD DE OPERACION']}}</td>
                              </tr>

                            <tr style="background-color: #FCECF4">
                                 <td>GASTOS NO OPERACIONALES</td>
                                 <td>{{$datos['GASTOS NO OPERACIONALES']}}</td>
                              </tr>

                              <tr style="background-color: #FCECF4">
                                 <td>UTILIDAD ANTES DEL IMPUESTO Y RESERVA</td>
                                 <td>{{$datos['UTILIDAD ANTES IMPUESTO Y RESERVA']}}</td>
                              </tr>

                               <tr style="background-color: #FCECF4">
                                 <td>PORCENTAJE RESERVA LEGAL</td>
                                 <td>{{$datos['PORCENTAJE RESERVA']}}</td>
                              </tr>

                              <tr style="background-color: #FCECF4">
                                 <td>RESERVA LEGAL</td>
                                 <td>{{$datos['RESERVA LEGAL']}}</td>
                              </tr>

                              <tr style="background-color: #FCECF4">
                                 <td>UTILIDAD ANTES DE IMPUESTO SOBRE LA RENTA</td>
                                 <td>{{$datos['UTILIDAD ANTES DE IMPUESTO RENTA']}}</td>
                              </tr>

                               <tr style="background-color: #FCECF4">
                                 <td>PORCENTAJE SOBRE LA RENTA</td>
                                 <td>{{$datos['PORCENTAJE RENTA']}}</td>
                              </tr>

                              <tr style="background-color: #FCECF4">
                                 <td>GASTOS DE IMPUESTO SOBRE LA RENTA</td>
                                 <td>{{$datos['GASTOS DE IMPUESTO RENTA']}}</td>
                              </tr>

                              <tr style="background-color: #FCECF4">
                                 <td>UTILIDAD NETA</td>
                                 <td>{{$datos['UTILIDAD NETA']}}</td>
                              </tr>
                             
                      </tbody>
                    </table>
                  </div>
                   <div  class="col col-lg-2">
      
                   </div>
                    </div>
                  </div>
                  
               <!--INFO-->

                  <div class="text-left">
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Info</button>
                  <div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Información sobre calculos</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <p>VENTAS NETAS  = VENTA DE VIENES - REBAJAS Y DEVOLUCIONES EN VENTA DE VIENES</p>
                          <br>
                          <p>UTILIDAD BRUTA = VENTAS NETAS - COSTO DE VENTA</p>
                          <br>
                          <p>UTILIDAD DE OPERACIÓN = UTILIDAD BRUTA - GASTOS DE OPERACIÓN</p>
                          <br>
                          <p>UTILIDAD ANTES DEL IMPUESTO Y RESERVA = UTILIDAD DE OPERACIÓN - GASTOS NO OPERACIONALES</p>
                          <br>
                          <p>RESERVA LEGAL = UTILIDAD ANTES DEL IMPUESTO Y RESERVA * PORCENTAJE RESERVA LEGAL</p>
                          <br>
                          <p>UTILIDAD ANTES DE IMPUESTO SOBRE LA RENTA = UTILIDAD ANTES DEL IMPUESTO Y RESERVA - RESERVA LEGAL</p>
                          <br>
                          <p>GASTOS DE IMPUESTO SOBRE LA RENTA = UTILIDAD ANTES DE IMPUESTO SOBRE LA RENTA * PORCENTAJE SOBRE LA RENTA</p>
                          <br>
                          <p>UTILIDAD NETA = UTILIDAD ANTES DE IMPUESTO SOBRE LA RENTA - GASTOS DE IMPUESTO SOBRE LA RENTA</p>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                        </div>

                      </div>
                    </div>
                  </div>
                  </div>
                  <!--INFO-->

                </div>
          </div>
        
  </div>
</div>





@endsection
