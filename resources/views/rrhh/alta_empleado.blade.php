@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">ALTA DE EMPLEADO</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
<form action="/rrhh/empleado_cargado" method="POST">
	{{ csrf_field() }}
 
 <div style="text-align:left;">
<table>
	
	<tr>
		<th>Nombre:</th>
		<td><input type="text" name="nombre" id="nombre"></td>
	</tr>
	<tr>
		<th>Apellido:</th>
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
		<th>correo:</th>
		<td><input type="email" name="correo" id="correo"></td>
	</tr>
	<tr>
		<th>Estado:</th>
		<td><select name="estado" id="estado">
		<option value="1">Activo</option>
		<option value="0">Inactivo</option>
		</select>
		</td>
	</tr>
	<tr>
		<th>Grupos:</th>
		<td><select name="grupo" id="grupo">
		<option value="1">Predeterminado</option>
		<option value="2">Vendedores</option>
		</select>
		</td>
	</tr>
	<tr>
		<th>Observación</th>
		<td> <textarea name="observacion" id="observacion"></textarea></td>
	</tr>

</table>
</div>

<button class="btn btn-primary" type="submit">Cargar</button>
</form>




@endsection