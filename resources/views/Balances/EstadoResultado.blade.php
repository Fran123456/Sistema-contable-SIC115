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
                          <th width="100">-</th>
                          <th width="400">-</th>
                          <th width="300">Importe</th>
                        </tr>
                      </thead>
                      <tbody>
                              <tr style="background-color: #EBFAF7">
                                <td >+</td>
                                 <td >VENTA</td>
                                 <td>{{$datos['VENTA']}}</td>
                              </tr>

                              <tr style="background-color: #EBFAF7">
                                <td >-</td>
                                 <td >DESCUENTO DE VENTA</td>
                                 <td>{{$datos['DESCUENTO DE VENTA']}}</td>
                              </tr>

                              <tr style="background-color: #C8E5DF">
                                <td >=</td>
                                 <td>VENTA NETA</td>
                                 <td>{{$datos['VENTA NETA']}}</td>
                              </tr>

                              <tr style="background-color: #FCECF4">
                                <td >+</td>
                                 <td>MANO DE OBRA</td>
                                 <td>{{$datos['MANO DE OBRA']}}</td>
                              </tr>

                              <tr style="background-color: #FCECF4">
                                <td >+</td>
                                 <td>MATERIA PRIMA</td>
                                 <td>{{$datos['MATERIA PRIMA']}}</td>
                              </tr>

                              <tr style="background-color: #F7D7E7">
                                <td >=</td>
                                 <td>COSTO POR VENTA</td>
                                 <td>{{$datos['COSTO POR VENTA']}}</td>
                              </tr>

                              <tr style="background-color: #FCF4DC">
                                <td >+</td>
                                 <td>VENTA NETA</td>
                                 <td>{{$datos['VENTA NETA']}}</td>
                              </tr>

                              <tr style="background-color: #FCF4DC">
                                <td >-</td>
                                 <td>COSTO POR VENTA</td>
                                 <td>{{$datos['COSTO POR VENTA']}}</td>
                              </tr>

                              <tr style="background-color: #EADDB7">
                                <td >=</td>
                                 <td>UTILIDAD BRUTA</td>
                                 <td>{{$datos['UTILIDAD BRUTA']}}</td>
                              </tr>

                              <tr style="background-color: #fff">
                                <td >+</td>
                                 <td>GASTOS ADMINISTRATIVOS</td>
                                 <td>{{$datos['GASTOS ADMINISTRATIVOS']}}</td>
                              </tr>

                              <tr style="background-color: #fff">
                                <td >+</td>
                                 <td>GASTOS DE VENTA</td>
                                 <td>{{$datos['GASTOS DE VENTA']}}</td>
                              </tr>

                               <tr style="background-color: #EDE9F7">
                                <td >=</td>
                                 <td>TOTAL DE GASTOS</td>
                                 <td>{{$datos['TOTAL GASTOS']}}</td>
                              </tr>


                              <tr style="background-color: #E6F5B6">
                                <td >+</td>
                                 <td>UTILIDAD BRUTA</td>
                                 <td>{{$datos['UTILIDAD BRUTA']}}</td>
                              </tr>

                              <tr style="background-color: #E6F5B6">
                                <td >-</td>
                                 <td>TOTAL DE GASTOS</td>
                                 <td>{{$datos['TOTAL GASTOS']}}</td>
                              </tr>

                              <tr style="background-color: #C6D695">
                                <td >=</td>
                                 <td>UTILIDAD</td>
                                 <td>{{$datos['UTILIDAD']}}</td>
                              </tr>

                             
                      </tbody>
                    </table>
                  </div>
                   <div  class="col col-lg-2">
      
                   </div>
                    </div>
                  </div>
                  
                </div>
          </div>
        
    
   
  </div>
</div>





@endsection
