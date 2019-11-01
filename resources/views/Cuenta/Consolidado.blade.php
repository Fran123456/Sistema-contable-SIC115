@extends('layouts.main')

@section('content')

<style type="text/css">
	.red_error{
		color: red;
	}
</style>


<div class="col-md-6 col-sm-6 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <h2>{{$cuentaInfo->nombre}}</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <table class="table table-hover text-center">
                      <thead>
                        <tr>
                          <th>DEBE</th>
                          <th>HABER</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cuenta as $key=> $value)
                          <tr>
                            @if ($value->debe != null || $value->debe != "")
                              <td>$ {{$value->monto}}</td>
                            @else
                             <td></td>
                            @endif

                            @if ($value->haber != null || $value->haber != "")
                              <td>$ {{$value->monto}}</td>
                            @else
                             <td></td>
                            @endif

                          </tr>
                        @endforeach
                          <tr>
                            <td style="background-color: #E0E3E3">$ {{$debe}}</td>
                            <td style="background-color: #E0E3E3">$ {{$haber}}</td>
                          </tr>
                          <tr>
                            @if($debe > $haber)
                              <td>$ {{$mayorizacion }}</td>
                              <td></td>
                            @elseif($debe < $haber)
                              <td></td>
                              <td>$ {{$mayorizacion }}</td>
                            @else
                            <td>$ {{$mayorizacion }}</td>
                            @endif
                          </tr>
                      </tbody>
                    </table>

                  </div>
                </div>
              </div>


@endsection


