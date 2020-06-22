@extends('layouts.app')
@section('content')
@include('layouts.menu_oficial')
  <div class="container">
<p></p>
    <div class="page-header">
        <h2>Alta de Usuario Empresa</h2>
    </div>
<p></p>

  @isset($error)
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
      <strong>{{ $error }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @endisset

    <form action="/oficial/empresa_cargado" id="formulario-form" method="post"  role="form">
      {{ csrf_field() }}
        <div class="row justify-content-md-center">
            <!--Primera columna de Carga de Datos-->
            <div class="col-md-5 col-md-offset-5">

              <div class="form-group row">
                <label for="cedula" class="col-lg-2 col-form-label">Cédula:</label>
                <div class="col-lg-10">
                    <input class="form-control" id="cedula" name="cedula" type="text" value="{{old('cedula')}}" maxlength="7" required focus min="5">
                    {!! $errors->first('cedula','<small class=error>:message</small><br>') !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="nombre" class="col-lg-2 col-form-label">Nombres:</label>
                <div class="col-lg-10">
                    <input class="form-control" id="nombre" name="nombre" type="text" value="{{old('nombre')}}" maxlength="50" required focus>
                    {!! $errors->first('nombre','<small class=error>:message</small><br>') !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="apellido" class="col-lg-2 col-form-label">Apellidos:</label>
                <div class="col-lg-10">
                    <input class="form-control" id="apellido" name="apellido" type="text" value="{{old('apellido')}}" maxlength="50" required focus>
                    {!! $errors->first('apellido','<small class=error>:message</small><br>') !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="telefono" class="col-lg-2 col-form-label">Teléfono:</label>
                <div class="col-lg-10">
                    <input class="form-control" id="telefono" name="telefono" type="text" value="{{old('telefono')}}" maxlength="20">
                    {!! $errors->first('telefono','<small class=error>:message</small><br>') !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="celular" class="col-lg-2 col-form-label">Celular:</label>
                <div class="col-lg-10">
                    <input class="form-control" id="celular" name="celular" type="text" value="{{old('celular')}}" maxlength="20" required focus>
                    {!! $errors->first('celular','<small class=error>:message</small><br>') !!}
                </div>
              </div>

            </div>
            <!--Segunda columna de Carga de Datos -->
            <div class="col-md-5 col-md-offset-5">

              <div class="form-group row">
                  <label for="dpto" class="col-lg-2 col-form-label">Dpto:</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="dpto" name="dpto" type="text" value="{{old('dpto')}}" maxlength="100">
                        {!! $errors->first('dpto','<small class=error>:message</small><br>') !!}
                    </div>
              </div>

              <div class="form-group row">
                <label for="cargo" class="col-lg-2 col-form-label">Cargo:</label>
                <div class="col-lg-10">
                    <input class="form-control" id="cargo" name="cargo" type="text" value="{{old('cargo')}}" maxlength="100">
                    {!! $errors->first('cargo','<small class=error>:message</small><br>') !!}
                </div>
              </div>

              <div class="form-group row">
                  <label for="correo" class="col-lg-2 col-form-label">Correo:</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="correo" name="correo" type="email" value="{{old('correo')}}" maxlength="100" required focus>
                        {!! $errors->first('correo','<small class=error>:message</small><br>') !!}
                    </div>
              </div>

              <div class="form-group row">
                <label for="estado" class="col-lg-2 col-form-label">Estado:</label>
                <div class="col-lg-10">
                  <select class="form-control" id="estado" name="estado" value="{{old('estado')}}" required focus max="1">
                    <option value="1">Activo</option>
                    <option value="0">Inactivo</option>
                  </select>
                  {!! $errors->first('estado','<small class=error>:message</small><br>') !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="observacion" class="col-lg-2 col-form-label">Obs:</label>
                <div class="col-lg-10">
                     <textarea class="form-control" id="observacion" name="observacion" rows="1" maxlength="500">{{old('observacion')}}</textarea>
                     {!! $errors->first('observacion','<small class=error>:message</small><br>') !!}
                </div>
              </div>
            </div>
        </div>
        <button class="btn btn-success" type="submit">Cargar usuario</button>
        <a class="btn btn-danger" href="/oficial/busqueda_empresa">Cancelar</a>
    </form>

  </div>

@endsection