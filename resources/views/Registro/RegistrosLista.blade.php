@extends('layouts.main')

@section('content')

<style type="text/css">
	.red_error{
		color: red;
	}
</style>


<div class="col-md-12 col-sm-12 col-xs-12">
  <form class="" action="{{ route('registros_fecha') }}" method="get">
    
    <h5>Busca por fecha (Seleccione MES si desea buscar solo por mes y año.)</h5>
            <div class="form-group row">
                    <div class="col-sm-3">
                          <div class="input-group">
                            <span class="input-group-btn">
                             <button type="submit" class="btn btn-primary go-class"><i class="fa fa-search"></i></button>
                             </span>
                            <input type="date" name="date" class="form-control">
                          </div>
                    </div>

                   <div class="checkbox">
                       <input name="mes" class="form-control" type="checkbox" value="MES"> <span class="input-group">MES</span>
                  </div>
            </div>
            
  </form>
</div>



<div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{ $mes }}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    @if (count($registros) > 0 )
                    <table id="myTable" class="table">
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>Fecha</th>
                          <th>Monto</th>
                          <th>Descripción</th>
                          <th>Código cuenta</th>
                          <th>Cuenta</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach ($registros as $key =>  $value)
                              <tr>
                                 <th scope="row">{{$key+1}}</th>
                                 <td>{{$value->fecha}}</td>
                                 <td>{{$value->monto}}</td>
                                 <td>{{$value->descripcion}}</td>
                                 <td>{{$value->codigo}}</td>
                                 <td>{{$value->nombre}}</td>
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                     @else
                        <h2>No hay registros</h2>
                     @endif

                     {{$registros->links()}}

                  </div>
                </div>
              </div>
@endsection
