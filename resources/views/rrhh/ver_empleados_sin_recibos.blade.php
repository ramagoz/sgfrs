@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">EMPLEADOS CON RECIBOS PENDIENTES</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>

	<table id="example" style="width:20%" align="center" border="2">
		<thead>
		<tr><th>Año</th><th>Mes</th><th>Cedula</th></tr>
		</thead>

	@foreach ($datos as $dato)
		<tbody>
		<tr>
			<td>{{  $año }}</td>
			<td>{{  $mes }}</td>
			<td>{{ $dato->cedula }}</td>
		</tr>
		</tbody>
	@endforeach

	</table>

	@if(isset($msj))
		<div class="alert alert-warning" role="alert" align="center">{{ $msj }}</div>
	@endif

<div align="center">
<br>
	@if(isset($boton))
	<a class="btn btn-outline-info" href="{{ $datos->previousPageUrl() }}" role="button">Anterior</a>
	<a class="btn btn-outline-info" href="{{ $datos->nextPageUrl() }}" role="button">Siguiente</a>
	@endif
</div>
<br>
<div align="center">
<a class="btn btn-primary" href="{{ url('/rrhh/empleados_sin_recibos' ) }}">Volver</a>
</div>
@endsection