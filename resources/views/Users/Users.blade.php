@extends('layouts.main')

@section('content')


<form method="post" action="{{ route('Usuarios.store') }}">
  @csrf
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" style="display: none;">
          <div class="modal-dialog modal-lg">
                      <div class="modal-content">

                        <div class="modal-header">
                          <h4 class="modal-title" id="myModalLabel">Crear un nuevo usuario</h4>
                          <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span>
                          </button>
                        </div>
                        <div class="modal-body">
                          
                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Nombre:</label>
                            <div class="col-md-9 col-sm-9 ">
                              <input  type="text" required="" name="nombre" class="form-control" >
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Correo:</label>
                            <div class="col-md-9 col-sm-9 ">
                              <input required="" name="correo" type="email" class="form-control">
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Tipo:</label>
                            <div class="col-md-9 col-sm-9 ">
                              <select class="form-control" name="tipo">
                                <option value="administrador">administrador</option>
                                <option value="contador">contador</option>
                              </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="col-form-label col-md-3 col-sm-3 ">Contraseña:</label>
                            <div class="col-md-9 col-sm-9 ">
                              <input required="" name="pass" type="text" class="form-control">
                              <span>(No olvides la contraseña, la unica forma para recuperarla sera reseteandola)</span>
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

  <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bs-example-modal-lg">Crear usuario</button>

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

                   @if (count($u) > 0 )
                    <table id="myTable" class="table text-center">
                      <thead>
                        <tr>
                          <th width="100">N</th>
                          <th>Nombre</th>
                          <th>Correo</th>
                          <th>Tipo</th>
                          <th>Editar</th>
                          <th>Eliminar</th>
                        </tr>
                      </thead>
                      <tbody>
                          @foreach($u as $key => $value)
                              <tr>
                                <td>{{$key+1}}</td>
                                 <td>{{$value->name}}</td>
                                 <td>{{$value->email}}</td>
                                 <td>{{$value->tipo}}</td>
                                 @if(Auth::user()->id == $value->id)
                                 <td> <a  href="" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a> </td>
                                 <td>-</td>
                                 @else
                                  <td> <a href="" class="btn btn-warning"><i class="fa fa-pencil" aria-hidden="true"></i></a> </td>
                                 <td><a href="" class="btn btn-danger"><i class="fa fa-trash" aria-hidden="true"></i></a></td>
                                 @endif
                              </tr>
                          @endforeach
                      </tbody>
                    </table>
                     @else
                        <h2>No hay registros</h2>
                     @endif
                     {{$u->links()}}

                </div>
          </div>
</div>
 

@endsection
