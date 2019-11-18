@extends('layouts.main')

@section('content')




<form method="post" action="{{ route('confResultadoCrear') }}">
  @csrf
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Asignar cuentas T</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                        
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Tipo:</label>
                            <div class="col-md-9 col-sm-9 ">
                              <select class="form-control" name="tipo">
                                <option value="VENTA DE VIENES">VENTA DE VIENES</option>
                                <option value="REBAJAS Y DEVOLUCIONES EN VENTA DE VIENES">REBAJAS Y DEVOLUCIONES EN VENTA DE VIENES</option>
                                <option value="COSTO DE VENTA">COSTO DE VENTA</option>
                                <option value="GASTOS DE OPERACION">GASTOS DE OPERACION</option>
                                <option value="GASTOS NO OPERACIONALES">GASTOS NO OPERACIONALES</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Tipo de cuenta:</label>
                            <div class="col-md-9 col-sm-9 ">
                              <select class="form-control" name="cuenta">
                                @for ($i = 0; $i <count($data) ; $i++)
                                    <option value="{{$data[$i]->id}}">{{$data[$i]->nombre}}</option>
                                @endfor
                              </select> 
                            </div>
                        </div>

                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                          <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>

                      </div>
          </div>
 </div>
 </form>



<div class="col-md-12">


@if(session('success'))
   <div class="alert alert-success alert-dismissible " role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
         </button>
         {!! session('success') !!}
   </div>
@endif



  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Agregar</button>
      <div class="x_panel">
          <div class="x_title">
               <h2>Resumen</h2>
               <ul class="nav navbar-right panel_toolbox">
                <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
               </ul>
             <div class="clearfix"></div>
          </div>
          <div class="x_content bs-example-popovers">
             @if(count($registros)> 0)
                <table class="table table-striped">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Cuenta</th>
                          <th>Tipo</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($registros as $key => $element)
                         <tr>
                          <th scope="row">{{$key+1}}</th>
                          <td>{{$element->nombre}}</td>
                          <td>{{$element->tipo}}</td>
                          <td><a class="btn btn-danger" href="{{ route('eliminarEstado', $element->id ) }}"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                        </tr>
                        @endforeach
                      </tbody>
                  </table>
                @else
                  <h3>No hay registros</h3>
                @endif

          </div>
    </div>  
</div>

@endsection


