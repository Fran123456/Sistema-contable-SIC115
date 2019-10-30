@extends('layouts.main')

@section('content')

<div class="col-md-12">
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
                    <form id="demo-form2" data-parsley-validate="" class="form-horizontal form-label-left" novalidate="">


                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Fecha transacción <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="date" name="last-name" required="required" class="form-control">
                        </div>
                      </div>
                      
                      <br>

                      <div class="text-center"><h4>HABER</h4></div>
                      <hr>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Selecione una cuenta <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                        	<select required="" class="form-control">
	                        	@foreach ($cuentas as $key=> $value)
	                        		<option>{{$value->nombre}}</option>
	                        	@endforeach
                            </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Monto <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="number" step="0.01" name="last-name" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Descripción</label>
                        <div class="col-md-6 col-sm-6 ">
                          <textarea class="form-control"></textarea>
                        </div>
                      </div>
                     
                     <br>
                     <div class="text-center"><h4>DEBE</h4></div>
                      <hr>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Selecione una cuenta <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                            <select required="" class="form-control">
	                        	@foreach ($cuentas as $key=> $value)
	                        		<option>{{$value->nombre}}</option>
	                        	@endforeach
                            </select>
                        </div>
                      </div>
                      <div class="item form-group">
                        <label class="col-form-label col-md-3 col-sm-3 label-align" for="last-name">Monto <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 ">
                          <input type="number" step="0.01" name="last-name" required="required" class="form-control">
                        </div>
                      </div>
                      <div class="item form-group">
                        <label for="middle-name" class="col-form-label col-md-3 col-sm-3 label-align">Descripción</label>
                        <div class="col-md-6 col-sm-6 ">
                          <textarea class="form-control"></textarea>
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
 

@endsection
