@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">CREAR NUEVO PERIODO</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
	<br>

	<form action="/rrhh/crear_nuevo_periodo" method="POST">	
	{{csrf_field()}}

	<div align="center" id="prueba">
		<table style="width:20%" >
			<tr> 
				<th>Mes: </th>
				<td><select name="mes" id="mes"> 
				   <option value="1">Enero</option> 
				   <option value="2">Febrero</option> 
				   <option value="3">Marzo</option>
				   <option value="4">Abril</option> 
				   <option value="5">Mayo</option> 
				   <option value="6">Junio</option>
				   <option value="7">Julio</option> 
				   <option value="8">Agosto</option> 
				   <option value="9">Setiembre</option>
				   <option value="10">Octubre</option> 
				   <option value="11">Noviembre</option> 
				   <option value="12">Diciembre</option>
				</select></td>
			</tr>

			<tr> 
				<th>Año:</th>
				<td><input type="text" value="{{ date("Y") }}" name="año" id="año" required=""></td>
			</tr>
		</table>
		<br>
			<button class="btn btn-primary" type="submit">Crear nuevo periodo</button>
	</div>
	</form>

@endsection