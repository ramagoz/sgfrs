@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_oficial')
	<h3 align="center">MODIFICACION DE ROLES </h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Oficial de Seguridad</strong></p>

<div class="container" align="center">

 <form action="{{url('/oficial/rol_modificado')}}" id="formulario-form" method="get"  role="form"> {{ csrf_field() }}
    <div class="row justify-content-md-center">
    	@foreach($persona as $persona)
          <!--Primera columna de Carga de Datos-->
		  <div class="col-5">
				
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
                		<label for="telefono" class="col-lg-2 col-form-label">Teléfono:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="telefono" name="telefono" type="text" value="{{$persona->tel}}" readonly>
                			</div>
              	</div>
             	<div class="form-group row">
                		<label for="celular" class="col-lg-2 col-form-label">Celular:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="celular" name="celular" type="text" value="{{$persona->cel}}" readonly>
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="dpto" class="col-lg-2 col-form-label">Dpto:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="dpto" name="dpto" type="text" value="{{$persona->dpto}}" readonly>
                			</div>
              	</div>
				    
		  </div>
		<!--Segunda columna de Carga de Datos -->
    	  <div class="col-md-5 col-md-offset-5">
			   <div class="form-group row">
                		<label for="cargo" class="col-lg-2 col-form-label">Cargo:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="cargo" name="cargo" type="text" value="{{$persona->cargo}}" readonly>
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="correo" class="col-lg-2 col-form-label">Correo:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="correo" name="correo" type="email" value="{{$persona->correo}}" readonly>
                			</div>
              	</div>
                      

                 <div class="form-group row ">
                    <label for="grupo" class="col-lg-2 col-form-label">Rol:</label>
                      <div class="col-lg-10" >
                          <select class="form-control" style="background-color:yellow;" id="rol" name="rol">
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

              	 <div class="form-group row">
                		<label for="observacion" class="col-lg-2 col-form-label">Obs:</label>
                			<div class="col-lg-10">
                  				 <textarea class="form-control" id="observacion" name="observacion" rows="4" readonly>{{$persona->obs}} </textarea  >
                			</div>
              	 </div>

		  </div>
		@endforeach
	</div>
	  <button class="btn btn-success" type="submit">Cambiar Rol</button>
 </form>
</div>

@endsection
