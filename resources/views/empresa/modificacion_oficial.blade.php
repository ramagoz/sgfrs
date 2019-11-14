@extends('layouts.app')
@include('layouts.menu_empresa')
@section('content')
  <div class="container-fluid">
    <br>
    <div class="page-header">
        <h2>Actualizar datos usuario Oficial de Seguridad</h2>
    </div>
    <br>
    {{-- Mensaje de error --}}

    @isset($error)
      <div class="alert alert-warning" role="alert" align="center">{{ $error }}</div>
    @endisset


    <form action="{{url('/empresa/oficial_modificado')}}" id="formulario-form" method="get"  role="form">
      {{ csrf_field() }}
        <div class="row justify-content-md-center">
            <!--Primera columna de Carga de Datos-->
            <div class="col-md-5 col-md-offset-5">

              <div class="form-group row">
                <label for="cedula" class="col-lg-2 col-form-label">Cédula:</label>
                <div class="col-lg-10">
                    <input class="form-control" id="cedula" name="cedula" type="text" value="{{$persona->cedula}}" maxlength="7" required focus>
                    {!! $errors->first('cedula','<small class=error>:message</small><br>') !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="nombre" class="col-lg-2 col-form-label">Nombres:</label>
                <div class="col-lg-10">
                    <input class="form-control" id="nombre" name="nombre" type="text" value="{{$persona->nombres}}" maxlength="50" required focus>
                    {!! $errors->first('nombre','<small class=error>:message</small><br>') !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="apellido" class="col-lg-2 col-form-label">Apellidos:</label>
                <div class="col-lg-10">
                    <input class="form-control" id="apellido" name="apellido" type="text" value="{{$persona->apellidos}}" maxlength="50" required focus>
                    {!! $errors->first('apellido','<small class=error>:message</small><br>') !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="telefono" class="col-lg-2 col-form-label">Teléfono:</label>
                <div class="col-lg-10">
                    <input class="form-control" id="telefono" name="telefono" type="text" value="{{$persona->tel}}" maxlength="20">
                    {!! $errors->first('telefono','<small class=error>:message</small><br>') !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="celular" class="col-lg-2 col-form-label">Celular:</label>
                <div class="col-lg-10">
                    <input class="form-control" id="celular" name="celular" type="text" value="{{$persona->cel}}" maxlength="20" required focus>
                    {!! $errors->first('celular','<small class=error>:message</small><br>') !!}
                </div>
              </div>

            </div>
            <!--Segunda columna de Carga de Datos -->
            <div class="col-md-5 col-md-offset-5">

              <div class="form-group row">
                  <label for="dpto" class="col-lg-2 col-form-label">Dpto:</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="dpto" name="dpto" type="text" value="{{$persona->dpto}}" maxlength="100">
                        {!! $errors->first('dpto','<small class=error>:message</small><br>') !!}
                    </div>
              </div>

              <div class="form-group row">
                <label for="cargo" class="col-lg-2 col-form-label">Cargo:</label>
                <div class="col-lg-10">
                    <input class="form-control" id="cargo" name="cargo" type="text" value="{{$persona->cargo}}" maxlength="100">
                    {!! $errors->first('cargo','<small class=error>:message</small><br>') !!}
                </div>
              </div>

              <div class="form-group row">
                  <label for="correo" class="col-lg-2 col-form-label">Correo:</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="correo" name="correo" type="email" value="{{$persona->correo}}" maxlength="100" required focus>
                        {!! $errors->first('correo','<small class=error>:message</small><br>') !!}
                    </div>
              </div>

              <div class="form-group row">
                <label for="estado" class="col-lg-2 col-form-label">Estado:</label>
                <div class="col-lg-10">
                  <select class="form-control" id="estado" name="estado" required focus max="1">
                    @if ($persona->estado ==1)
                      <option selected value="1">Activo</option>
                      <option value="0">Inactivo</option>
                    @else
                      <option value="1">Activo</option>
                      <option selected value="0">Inactivo</option>
                    @endif
                  </select>
                  {!! $errors->first('estado','<small class=error>:message</small><br>') !!}
                </div>
              </div>

              <div class="form-group row">
                <label for="observacion" class="col-lg-2 col-form-label">Obs:</label>
                <div class="col-lg-10">
                     <textarea class="form-control" id="observacion" name="observacion" rows="1" value="{{$persona->obs}}" maxlength="500"></textarea>
                     {!! $errors->first('observacion','<small class=error>:message</small><br>') !!}
                </div>
              </div>
            </div>
        </div>

        <input type="hidden" name="id_usuario" id="id_usuario" value={{ $persona->id_usuario }} >
        <button class="btn btn-success" type="submit">Actualizar</button>
        <a class="btn btn-danger" href="/empresa/busqueda_oficial">Cancelar</a>
    </form>

  </div>

@endsection