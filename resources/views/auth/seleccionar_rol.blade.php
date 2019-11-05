@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	<br><br><br><br>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-3">
            <div class="card">
    <div align="center" class="card-header">
	<h3 align="center">Selección de Rol</h1>
	</div>
	<form action="/auth/rol_seleccionado" method="POST">
	{{csrf_field()}}
	<div align="center" id="prueba">
		<div class="card-body">
		<table >
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
		</div>
			<button class="btn btn-primary" type="submit">Seleccionar</button>
			<br><br>
	</div>
	</form>
</div>
</div>
</div>
</div>
@endsection