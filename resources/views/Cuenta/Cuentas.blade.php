@extends('layouts.main')

@section('content')

<style type="text/css">
	.red_error{
		color: red;
	}
</style>


<div class="col-md-12">
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


