@extends('layouts.app')
@include('layouts.menu_empresa')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}

	<h3 align="center">ALTA OFICIAL DE SEGURIDAD</h1>
<div class="container" align="center">
  <!--Alerta si hubo modificacion de usuario-->
 <form action="/empresa/oficial_cargado" id="formulario-form" method="post"  role="form"> {{ csrf_field() }}
    <div class="row justify-content-md-center">

    <!--Primera columna de Carga de Datos-->
		  <div class="col-5">

				<div class="form-group row">
                		<label for="cedula" class="col-lg-2 col-form-label">Cédula:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="cedula" name="cedula" type="text" required>
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="nombre" class="col-lg-2 col-form-label">Nombres:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="nombre" name="nombre" type="text" required>
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="apellido" class="col-lg-2 col-form-label">Apellidos:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="apellido" name="apellido" type="text" required>
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="telefono" class="col-lg-2 col-form-label">Teléfono:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="telefono" name="telefono" type="text">
                			</div>
              	</div>
             	<div class="form-group row">
                		<label for="celular" class="col-lg-2 col-form-label">Celular:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="celular" name="celular" type="text" required>
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="dpto" class="col-lg-2 col-form-label">Dpto:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="dpto" name="dpto" type="text" >
                			</div>
              	</div>

		  </div>
	<!--Segunda columna de Carga de Datos -->
    	  <div class="col-md-5 col-md-offset-5">
			   <div class="form-group row">
                		<label for="cargo" class="col-lg-2 col-form-label">Cargo:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="cargo" name="cargo" type="text" >
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="correo" class="col-lg-2 col-form-label">Correo:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="correo" name="correo" type="email" required>
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="estado" class="col-lg-2 col-form-label">Estado:</label>
                			<div class="col-lg-10">
                  				<select class="form-control" id="estado" name="estado">
						            <option value="1">Activo</option>
						            <option value="0">Inactivo</option>
			        			</select>
                			</div>
              	</div>

              	<div class="form-group row">
                    <label for="grupo" class="col-lg-2 col-form-label">Grupo:</label>
                      <div class="col-lg-10">
                          <select class="form-control" id="grupo" name="grupo">

                        @foreach($nombre_grupos as $grupo)
                        <option value="{{$grupo->id_grupo}}">
                            {{$grupo->nombre_grupo}}
                        </option>
                        @endforeach
                    </select>
                      </div>
                 </div>
              	 <div class="form-group row">
                		<label for="observacion" class="col-lg-2 col-form-label">Obs:</label>
                			<div class="col-lg-10">
                  				 <textarea class="form-control" id="observacion" name="observacion" rows="4"></textarea>
                			</div>
              	 </div>

		  </div>
	</div>
	  <button class="btn btn-success" type="submit">Cargar</button>
 </form>
</div>



@section('scripts')
<script src="{{asset('js/validator.js')}}"></script>
@endsection

@endsection