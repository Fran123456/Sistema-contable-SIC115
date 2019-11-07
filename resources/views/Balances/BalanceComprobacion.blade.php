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



<div class="col-md-12">


  <form class="" action="{{ route('cuenta_otro_balance_comp') }}" method="get">
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

 

          <div class="x_panel">
                <div class="x_title">
                  <h2></h2>
                  <ul class="nav navbar-right panel_toolbox">
                    <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                    </li>
                  </ul>
                  <div class="clearfix"></div>
                </div>
                <div class="x_content" style="display: block;">
                   @if (count($resultados) > 0 )
                   <div class="bs-example" data-example-id="simple-jumbotron">
                    <div class="jumbotron text-center">
                      <h3>Empresa</h3>
                      <p>{{$fecha}}</p>
                      <p>EN DOLARES ESTADOUNIDENSES       </p>
                    </div>
                  </div>

                    <table id="myTable" class="table">
                      <thead>
                        <tr>
                          <th width="400">Código cuenta</th>
                          <th>Cuenta</th>
                          <th>Debe</th>
                          <th>haber</th>
                        </tr>
                      </thead>
                      <tbody>
                          @for($i=0; $i<count($resultados); $i++)
                              <tr>
                                 <td>{{$resultados[$i]['codigo']}}</td>
                                 <td>{{$resultados[$i]['nombre']}}</td>
                                 <td>{{$resultados[$i]['haber']}}</td>
                                 <td>{{$resultados[$i]['debe']}}</td>
                              </tr>
                          @endfor

                           <tr style="background-color: #D0D8D8">
                                 <td></td>
                                 <td></td>
                                 <td>{{$debeF}}</td>
                                 <td>{{$haberF}}</td>
                              </tr>
                      </tbody>
                    </table>
                     @else
                        <h2>No hay registros</h2>
                     @endif
                     
                </div>
          </div>
        
            

</div>
 

@endsection
