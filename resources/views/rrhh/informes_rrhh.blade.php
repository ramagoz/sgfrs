@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">SELECCIONAR AÑO DEL INFORME</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>

	<form action="/rrhh/periodo_creado" method="POST">	
	{{csrf_field()}}

	<div align="center" id="prueba">
	<table style="width:20%" >		
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