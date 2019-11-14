@extends('layouts.app')
@include('layouts.menu_oficial')
@section('content')
<div class="container-fluid">

    <div class="page-header">
        <h2>Modificación de rol</h2>
    </div>

   <form action="{{url('/oficial/rol_modificado')}}" id="formulario-form" method="get"  role="form">
    {{ csrf_field() }}

    <div class="row">
        @foreach($persona as $persona)
            <div class="col-12 col-sm-8 col-lg-5 mx-auto">

              <div class="form-group row">
                <label for="cedula" class="col-lg-2 col-form-label">Cédula:</label>
                <div class="col-lg-10">
                    <input class="form-control" id="cedula" name="cedula" type="text" value="{{$persona->cedula}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                  <label for="nombre" class="col-lg-2 col-form-label">Nombres:</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="nombre" name="nombre" type="text" value="{{$persona->nombres}}" readonly>
                    </div>
              </div>

              <div class="form-group row">
                  <label for="apellido" class="col-lg-2 col-form-label">Apellidos:</label>
                    <div class="col-lg-10">
                        <input class="form-control" id="apellido" name="apellido" type="text" value="{{$persona->apellidos}}" readonly>
                    </div>
              </div>

              <div class="form-group row">
                <label for="dpto" class="col-lg-2 col-form-label">Dpto:</label>
                <div class="col-lg-10">
                  <input class="form-control" id="dpto" name="dpto" type="text" value="{{$persona->dpto}}" readonly>
                </div>
              </div>

              <div class="form-group row">
                  <label for="cargo" class="col-lg-2 col-form-label">Cargo:</label>
                  <div class="col-lg-10">
                      <input class="form-control" id="cargo" name="cargo" type="text" value="{{$persona->cargo}}" readonly>
                  </div>
              </div>

              <div class="form-group row ">
                <label for="grupo" class="col-lg-2 col-form-label">Rol:</label>
                  <div class="col-lg-10" >
                    <select class="form-control" id="rol" name="rol">
                      @foreach($nombre_rol as $rol)
                        @if("{{$persona->id_rol}}"=="{{$rol->id_rol}}")
                          <option value="{{$rol->id_rol}}" selected="true">{{$rol->rol}} </option>
                        @else
                          <option value="{{$rol->id_rol}}">{{$rol->rol}}</option>
                        @endif
                      @endforeach
                  </select>
                </div>
              </div>
            </div>
        @endforeach
    </div>

    <button class="btn btn-success" type="submit">Cambiar Rol</button>
    <a class="btn btn-danger" href="/oficial/roles">Cancelar</a>
   </form>

</div>
@endsection
