@extends('layouts.main')

@section('content')

<style type="text/css">
	.red_error{
		color: red;
	}
</style>



<div class="col-md-12">

    @if(session('success'))
   <div class="alert alert-success alert-dismissible " role="alert">
         <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>
         </button>
         {{ session('success') }}
   </div>
   @endif

	<div class="x_panel">
                  <div class="x_title">
                    <h2>REGISTRO CONTABLE</h2>
                    <ul class="nav navbar-right panel_toolbox">
                      <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                      </li>
                    </ul>
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <br>
                    <form method="post" action="{{ route('Registro.store') }}" class="form-horizontal form-label-left">
                        @csrf

                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fecha transacción <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="date" name="fecha" required="required" class="form-control">
                        </div>
                      </div>
                      
                      <br>

                      <div class="text-center"><h4>HABER</h4></div>
                      <hr>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Selecione una cuenta <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                        	<select required="" class="form-control" name="cuentaA" id="cuentaA">
	                        	@foreach ($cuentas as $key=> $value)
	                        		<option value="{{$value->id}}">{{$value->nombre}}</option>
	                        	@endforeach
                            </select>
                            <div id="padreA">
                            	
                            </div>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Monto <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="number" step="0.01" name="montoA" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Descripción</label>
                        <div class="col-md-6 col-sm-6 ">
                          <textarea name="desA" class="form-control"></textarea>
                        </div>
                      </div>
                     
                     <br>
                     <div class="text-center"><h4>DEBE</h4></div>
                      <hr>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Selecione una cuenta <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select required="" class="form-control" name="cuentaB" id="cuentaB">
	                        	@foreach ($cuentas as $key=> $value)
	                        	    @if ($key == 1)
	                        	    	<option selected="" value="{{$value->id}}">{{$value->nombre}}</option>
	                        	    @else
	                        	      <option value="{{$value->id}}">{{$value->nombre}}</option>
	                        	    @endif
	                        		
	                        	@endforeach
                            </select>
                            <div id="padreB">
                            	
                            </div>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Monto <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="number" step="0.01" name="montoB" required class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Descripción</label>
                        <div class="col-md-6 col-sm-6 ">
                          <textarea name="desB" class="form-control"></textarea>
                        </div>
                      </div>

                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3">
                          <button type="submit" class="btn btn-success">Agregar</button>
                        </div>
                      </div>
                    </form>
                  </div>
                </div>
</div>

<script type="text/javascript">
	

    //cambio de A
	$("#cuentaA").change(function(){
		var cuentaA = $('#cuentaA').val();
	    var cuentaB = $('#cuentaB').val();
	    error_(cuentaA , cuentaB, 'AA');
	});

	//cambio de B
	$("#cuentaB").change(function(){
		var cuentaA = $('#cuentaA').val();
	    var cuentaB = $('#cuentaB').val();
	    error_(cuentaA , cuentaB,'BB');
	});


	function cambio_select(cuentaA , cuentaB){
        if(cuentaA == cuentaB) return true
        else return false;
	}

	function error_(cuentaA , cuentaB, estado){
        $('#errorB').remove();
        $('#errorA').remove();

		if(cambio_select(cuentaA,cuentaB)== true){
			if(estado == 'AA'){
              $('#padreA').append('<span id="errorA" class="red_error">Error, no puede seleccionar la misma cuenta </span>');
			}else{
				$('#padreB').append('<span id="errorB" class="red_error">Error, no puede seleccionar la misma cuenta </span>');
			}
	    }else{
	    	$('#errorB').remove();
	    	$('#errorA').remove();
	    }
	}



</script>
 

@endsection
