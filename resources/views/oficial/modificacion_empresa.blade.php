@extends('layouts.app')
@section('content')
@include('layouts.menu_oficial')
  <div class="container">
  <p></p>
    <div class="page-header">
        <h2>Actualizar Datos Usuario Empresa</h2>
    </div>
<p></p>


    @isset($error)
      <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>{{ $error }}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
      </div>
    @endisset

    <form action="/oficial/empresa_modificado" method="post">
      {{ csrf_field() }}

      <div class="row justify-content-md-center">
          <!--Primera columna de Carga de Datos-->
          <div class="col-md-5 col-md-offset-5">

            <div class="form-group row">
              <label for="cedula" class="col-lg-2 col-form-label">Cédula:</label>
              <div class="col-lg-10">
                    <input class="form-control" id="cedula" name="cedula" type="text" value="{{$persona->cedula}}" maxlength="7" required focus readonly>
                  {!! $errors->first('cedula','<small class=error>:message</small><br>') !!}
              </div>
            </div>

            <div class="form-group row">
              <label for="nombres" class="col-lg-2 col-form-label">Nombres:</label>
              <div class="col-lg-10">
                   <input class="form-control" id="nombres" name="nombres" type="text" value="{{old('nombres', $persona->nombres)}}" maxlength="50" required focus>

                  {!! $errors->first('nombres','<small class=error>:message</small><br>') !!}
              </div>
            </div>

            <div class="form-group row">
              <label for="apellidos" class="col-lg-2 col-form-label">Apellidos:</label>
              <div class="col-lg-10">
                  <input class="form-control" id="apellidos" name="apellidos" type="text" value="{{old('apellidos', $persona->apellidos)}}" maxlength="50" required focus>
                  {!! $errors->first('apellidos','<small class=error>:message</small><br>') !!}
              </div>
            </div>

            <div class="form-group row">
              <label for="tel" class="col-lg-2 col-form-label">Teléfono:</label>
              <div class="col-lg-10">
                  <input class="form-control" id="tel" name="tel" type="text" value="{{old('tel', $persona->tel)}}" maxlength="20">
                  {!! $errors->first('tel','<small class=error>:message</small><br>') !!}
              </div>
            </div>

            <div class="form-group row">
              <label for="cel" class="col-lg-2 col-form-label">Celular:</label>
              <div class="col-lg-10">
                  <input class="form-control" id="cel" name="cel" type="text" value="{{old('cel', $persona->cel)}}" maxlength="20" required focus>
                  {!! $errors->first('cel','<small class=error>:message</small><br>') !!}
              </div>
            </div>

          </div>
          <!--Segunda columna de Carga de Datos -->
          <div class="col-md-5 col-md-offset-5">

            <div class="form-group row">
                <label for="dpto" class="col-lg-2 col-form-label">Dpto:</label>
                  <div class="col-lg-10">
                      <input class="form-control" id="dpto" name="dpto" type="text" value="{{old('dpto', $persona->dpto)}}" maxlength="100">
                      {!! $errors->first('dpto','<small class=error>:message</small><br>') !!}
                  </div>
            </div>

            <div class="form-group row">
              <label for="cargo" class="col-lg-2 col-form-label">Cargo:</label>
              <div class="col-lg-10">
                  <input class="form-control" id="cargo" name="cargo" type="text" value="{{old('cargo', $persona->cargo)}}" maxlength="100">
                  {!! $errors->first('cargo','<small class=error>:message</small><br>') !!}
              </div>
            </div>

            <div class="form-group row">
                <label for="correo" class="col-lg-2 col-form-label">Correo:</label>
                  <div class="col-lg-10">
                      <input class="form-control" id="correo" name="correo" type="email" value="{{old('correo', $persona->correo)}}" maxlength="100" required focus>
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
              <label for="obs" class="col-lg-2 col-form-label">Obs:</label>
              <div class="col-lg-10">
                   <textarea class="form-control" id="obs" name="obs" rows="1" maxlength="500">{{old('observacion', $persona->obs)}}</textarea>
                   {!! $errors->first('obs','<small class=error>:message</small><br>') !!}
              </div>
            </div>
          </div>
      </div>

      <input type="hidden" name="id_usuario" id="id_usuario" value={{ $persona->id_usuario }} >
    	<button class="btn btn-success" type="submit">Actualizar Datos</button>
       <a class="btn btn-danger" href="/oficial/busqueda_empresa">Cancelar</a>
    </form>
  </div>
@endsection
