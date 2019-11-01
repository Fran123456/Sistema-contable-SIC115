@extends('layouts.main')

@section('content')

<style type="text/css">
	.red_error{
		color: red;
	}
</style>


<form method="post" action="{{ route('Cuenta.store') }}">
  @csrf
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Crear cuenta T</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Codigo cuenta:</label>
                            <div class="col-md-9 col-sm-9 ">
                              <input  type="text" required="" name="codigo" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Nombre cuenta:</label>
                            <div class="col-md-9 col-sm-9 ">
                              <input required="" name="cuenta" type="text" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Tipo de cuenta:</label>
                            <select class="form-control" name="tipo">
                              <option>ACTIVO</option>
                              <option>PASIVO</option>
                              <option>CAPITAL</option>
                              <option>CUENTAS DE RESULTADO DEUDOR</option>
                              <option>CUENTAS DE RESULTADO ACREEDOR</option>
                              <option>CUENTAS LIQUIDADORAS</option>
                            </select>
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




    <div>
     <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Crear cuenta T</button>
    </div>
        <div class="x_panel">
              <div class="x_title">
                  <h2>Cuentas T</h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
              </div>
              <div class="x_content">
                  <ul class="list-unstyled msg_list">
                    @foreach ($cuentas as $key => $value)
                    <li>
                      <a href="{{ route('Cuenta.show', $value->id)}}">
                        <span>
                          {{$value->codigo}} 
                        </span>
                        <span class="message">
                          {{$value->nombre}}
                        </span>
                      </a>
                    </li>
                    @endforeach
                  </ul>
             </div>
       </div>
</div>



@endsection


