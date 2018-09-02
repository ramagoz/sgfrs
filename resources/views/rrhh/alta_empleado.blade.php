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
<!--formulario de carga html
		<form action="/rrhh/empleado_cargado" method="POST">
			{{ csrf_field() }}

				 <table >
					
					<tr>
						<th>Nombres:</th>
						<td><input type="text" name="nombre" id="nombre"></td>
					</tr>
					<tr>
						<th>Apellidos:</th>
						<td><input type="text" name="apellido" id="apellido"></td>
					</tr>
					<tr>
						<th>Cédula:</th>
						<td><input type="text" name="cedula" id="cedula"></td>
					</tr>
					<tr>
						<th>Teléfono:</th>
						<td><input type="text" name="telefono" id="telefono"></td>
					</tr>
					<tr>
						<th>Célular:</th>
						<td><input type="text" name="celular" id="celular"></td>
					</tr>
					<tr>
						<th>Dpto:</th>
						<td><input type="text" name="dpto" id="dpto"></td>
					</tr>
					<tr>
						<th>Cargo:</th>
						<td><input type="text" name="cargo" id="cargo"></td>
					</tr>
					<tr>
						<th>Correo:</th>
						<td><input type="email" name="correo" id="correo"></td>
					</tr>
					<tr>
						<th>Estado:</th>
						<td>
						<select name="estado" id="estado">
						<option value="1">Activo</option>
						<option value="0">Inactivo</option>
						</select>
						</td>
					</tr>
					<tr>
						<th>Grupos:</th>
						<td>
							<select>
								@foreach($nombre_grupos as $grupo)
					                <option>{{$grupo->nombre_grupo}}</option>
					            @endforeach
				            </select>
						</td>
					</tr>
					<tr>
						<th>Observación</th>
						<td> <textarea name="observacion" id="observacion"></textarea></td>
					</tr>

				</table>

				<button class="btn btn-primary" type="submit">Cargar</button>
		</form>
<!--formulario de carga boostrap-->


<div class="container" align="center">

 <form action="/rrhh/empleado_cargado" id="formulario-form" method="post"  role="form"> {{ csrf_field() }}
    <div class="row justify-content-md-center">
    <!--Primera columna de Carga de Datos-->
		  <div class="col-5">
				
				<div class="form-group row">
                		<label for="cedula" class="col-lg-2 col-form-label">Cédula:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="cedula" name="cedula" type="text"> 
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="nombre" class="col-lg-2 col-form-label">Nombre:</label>
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
                		<label for="telefono" class="col-lg-2 col-form-label">Teléfono:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="telefono" name="telefono" type="text">
                			</div>
              	</div>
             	<div class="form-group row">
                		<label for="celular" class="col-lg-2 col-form-label">Celular:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="celular" name="celular" type="text">
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="dpto" class="col-lg-2 col-form-label">Dpto:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="dpto" name="dpto" type="text">
                			</div>
              	</div>
				    
		  </div>
	<!--Segunda columna de Carga de Datos -->
    	  <div class="col-md-5 col-md-offset-5">
			   <div class="form-group row">
                		<label for="cargo" class="col-lg-2 col-form-label">Cargo:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="cargo" name="cargo" type="text">
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="correo" class="col-lg-2 col-form-label">Correo:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="correo" name="correo" type="email">
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

@endsection
