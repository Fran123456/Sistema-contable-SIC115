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


  @if($soldado == 1)
   <div class="alert alert-danger alert-dismissible " role="alert">
        <strong>¿Desea finalizar el mes contable? (La fecha actual es: {{ date('d').'-'.date('m').'-'.date('Y') }})</strong> 
        
    </div>

    <a href="{{ route('finalizarMesContable', 'F') }}" class="btn btn-info">Finalizar</a>
  @else
    
    <h3>No hay registros aun para poder finalizar mes contable.</h3>
  @endif
</div>
 

@endsection
