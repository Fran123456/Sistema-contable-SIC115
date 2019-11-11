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

                   <div id="padreT">
                     <div id="1T">
                      <!--form-->
                        <hr>
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Selecione una cuenta <span class="required">*</span>
                          </label>
                          <div class="col-md-6 col-sm-6 ">
                              <div class="row">
                                <div class="col-md-7">
                                  <select required="" class="form-control cuentaS" name="cuenta1" id="cuenta1"></select>
                                    <div id="padreA"></div>
                                </div>
                                <div class="col-md-5">
                                  <select class="form-control" id="tipo1" name="tipo1">
                                    <option value="HABER">HABER</option>
                                    <option value="DEBE">DEBE</option>
                                  </select>
                                </div>
                              </div>
                          </div>
                        </div>
                        <div class="item form-group">
                          <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Monto <span class="required">*</span></label>
                          <div class="col-md-6 col-sm-6 " id="inpM">
                            <input type="number" step="0.01" name="monto1" id="monto1" required="required" class="form-control">
                          </div>
                        </div>
                        <div class="item form-group">
                          <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Descripción</label>
                          <div class="col-md-6 col-sm-6 "><textarea name="des1" id="des1" class="form-control"></textarea></div>
                        </div>
                        <!--form-->
                     </div>
                   </div>

                      <div class="ln_solid"></div>
                      <div class="item form-group">
                        <div class="col-md-6 col-sm-6 offset-md-3 text-center">
                          <button id="mas" type="button" onclick="agregar()" class="btn btn-warning">+</button>
                          <button id="menos" type="button" onclick="eliminar()" class="btn btn-danger">-</button>
                          <button id="valid" type="button" onclick="validar()" class="btn btn-success">Validar</button>
                          <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-sm">Calculadora de IVA</button>
                        </div>
                      </div>

                      <div class="text-center" id="msm">
                        <input type="text" hidden="" value="1" name="oculto" id="oculto">
                      </div>

                    </form>
                  </div>
                </div>
</div>



      <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-sm">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel2">IVA</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          <label>Cantidad:</label>
                          <input type="number" step="0.01" class="form-control" name="" id="cant">
                          <br>
                          <label>IVA %</label>
                          <input type="text" class="form-control" name="" id="iva" readonly="" value="13%">
                          <br>
                          <label>Resultado:</label>
                          <input type="" class="form-control" readonly="" id="res" name="">
                        </div>
                        <div class="modal-footer">
                          <button  type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                          <button type="button" onclick="iva_calculo()" class="btn btn-primary">Calcular</button>
                        </div>

                      </div>
                    </div>
          </div>


<script type="text/javascript">
//INCIO
var htmlx = "";
var cont = 1;
$(document).ready(function() {
        $.ajax({
            type: "GET",
            datatype: 'JSON',
            url: '{{ route('ajax_obtener_cuentas') }}',
            success: function(response)
            {
               for (var i = 0; i < response.length; i++) {
                 htmlx = htmlx +  '<option value="'+response[i].id+'">'+ response[i].nombre + '</option>';
               }
               $('#cuenta1').append(htmlx);
            },
            error: function() {
              console.log("No se ha podido obtener la información");
            }
       });
});
//INCIO


function agregar(){
cont++;
var ht =  html_agregar(cont);
  $('#padreT').append(ht);
}

function eliminar(){
  if(cont==1){
   alert('No puede eliminar');
  }else{
    $('#'+cont+'T').remove();
     cont--;
  }
}

function validar(){
  var cuentas=[];
  var monto=[];
  var tipo=[];
  var controlador = false;
  var mensajeCuentas = "";
  var haber = 0;
  var debe=0;
  for (var i = 1; i <= cont; i++) {
    cuentas.push($('#cuenta'+i).val());
    monto.push($('#monto'+i).val());
    tipo.push($('#tipo'+i).val());
  }

  for (var i = 0; i < cuentas.length; i++) {
    if(tipo[i]=='DEBE') debe = debe + parseFloat(monto[i]) ;
     else haber = haber+ parseFloat(monto[i]);
  }
  var rest = haber - debe;

  
  //validar cuentas T
  for (var i = 0; i < cuentas.length; i++) {
    for (var j = 0; j < cuentas.length; j++) {
      if(i!=j){
          if(cuentas[i] == cuentas[j]){
           controlador=true;
           mensajeCuentas = 'Error, hay dos o más cuentas repetidas';
           break;
          }
      }
      if(controlador) break;
    }
    if(controlador) break;
  }

  //Imprimir mensajes.
  if(controlador)$('#msm').append(mensaje_html(mensajeCuentas,'danger'));
  if(rest != 0)$('#msm').append(mensaje_html('Las cantidades no concuerdan, Haber: ' + haber + ' Debe ' + debe , 'danger' ));

  console.log(controlador + ' ' + rest);

  if(controlador==false && rest==0){
    $('#msm').append(mensaje_html('Todo esta correcto, puede continuar.','success'));
    $('#mas').attr("disabled", true);
    $('#menos').attr("disabled", true);
    $('#valid').attr("disabled", true);
    $('#msm').append('<button type="submit" class="btn btn-success">Agregar</button>');
    $('#oculto').val(cuentas.length);

    for(var i = 1; i <= cuentas.length; i++){
      $("#cuenta"+i).attr("readonly","readonly");
      $("#tipo"+i).attr("readonly","readonly");
      $("#monto"+i).attr("readonly","readonly");
      $("#des"+i).attr("readonly","readonly");
    }


  }

  
}

//Funcion IVA
$(document).on('change', '.cuentaS', function () 
{
   // var valor = $('#'+this.id).val();
});
//Funcion IVA

function iva_calculo(){
  cant  =  $('#cant').val() * 0.13;
  $('#res').val(cant);
  }



function mensaje_html(mensaje, tipo){
  html  = '<div class="alert alert-'+tipo+' alert-dismissible " role="alert">'+
         '<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>'+
         '</button>'+mensaje+'</div>';
  return html;
}

function html_agregar(n){
  htmlu = '<div id="'+n+'T">'+
                        '<hr>'+
                       '<div class="item form-group">'+
                          '<label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Selecione una cuenta <span class="required">*</span>'+
                          '</label>'+
                          '<div class="col-md-6 col-sm-6 ">'+
                              '<div class="row">'+
                                '<div class="col-md-7">'+
                                  '<select required="" class="form-control cuentaS" name="cuenta'+n+'" id="cuenta'+n+'">'+htmlx+'</select>'+
                                    '<div id="span'+n+'"></div>'+
                                '</div>'+
                                '<div class="col-md-5">'+
                                  '<select class="form-control" id="tipo'+n+'" name="tipo'+n+'">'+
                                    '<option value="HABER">HABER</option>'+
                                    '<option value="DEBE">DEBE</option>'+
                                  '</select>'+
                                '</div>'+
                              '</div>'+
                          '</div>'+
                        '</div>'+
                        '<div class="item form-group">'+
                         '<label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Monto <span class="required">*</span></label>'+
                          '<div class="col-md-6 col-sm-6 "><input type="number" step="0.01" name="monto'+n+'" id="monto'+n+'" required="required" class="form-control"></div>'+
                        '</div>'+
                        '<div class="item form-group">'+
                          '<label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Descripción</label>'+
                          '<div class="col-md-6 col-sm-6 "><textarea name="des'+n+'" id="des'+n+'" class="form-control"></textarea></div>'+
                        '</div>'+
                     '</div>';

                     return htmlu;
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
