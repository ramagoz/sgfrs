@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
<h3 align="center">
    ALTA DE EMPLEADO
</h3>
<p align="center">
    <strong>
        Usuario:
    </strong>
    {{ Auth::user()->name }}, esta conectado con el Rol de
    <strong>
        Recursos Humanos
    </strong>
</p>

<div class="container" align="center">

 <form action="/rrhh/usuario_creado" id="formulario-form" method="post"  role="form"> {{ csrf_field() }}
    <div class="row justify-content-md-center">
    <!--Primera columna de Carga de Datos-->
		  <div class="col-5">
				
		
              	<div class="form-group row">
                		<label for="nombre" class="col-lg-2 col-form-label">Nombres:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="nombre" name="nombre" type="text">
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="apellido" class="col-lg-2 col-form-label">Apellidos:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="apellido" name="apellido" type="text">
                			</div>
              	</div>

                <div class="form-group row">
                    <label for="correo" class="col-lg-2 col-form-label">Correo:</label>
                      <div class="col-lg-10">
                          <input class="form-control" id="correo" name="correo" type="email">
                      </div>
                </div>
                <div class="form-group row">
                    <label for="password" class="col-lg-2 col-form-label">Password:</label>
                      <div class="col-lg-10">
                          <input class="form-control" id="password" name="password" type="password">
                      </div>
                </div>

				    
		  </div>

	</div>
	  <button class="btn btn-success" type="submit">Cargar</button>
 </form>
</div>

@endsection
