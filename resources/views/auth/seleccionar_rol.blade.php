@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	<h3 align="center">SELECCIONAR ROL</h1>
	<br>
	<form action="/auth/rol_seleccionado" method="POST">	
	{{csrf_field()}}

	<div align="center" id="prueba">
		<table style="width:20%" >
			<tr> 
				<th>Rol de usuario: </th>
				<td><select name="rol_seleccionado" id="rol_seleccionado">
				@if ($rol==2)
				   <option value="rrhh">RRHH</option> 
				@endif
				@if ($rol==5) 
				   <option value="oficial">Oficial de Seguridad</option> 
				@endif
				@if ($rol==4)
				   <option value="empresa">Empresa</option> 
				@endif 
				@if ($rol==1 or $rol==2 or $rol==4 or $rol==5)
				   <option value="empleado">Empleado</option> 
				@endif
				</select></td>
			</tr>
		</table>
		<br>
			<button class="btn btn-primary" type="submit">Seleccionar</button>
	</div>
	</form>

@endsection