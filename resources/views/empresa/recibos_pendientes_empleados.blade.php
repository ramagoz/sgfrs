@extends('layouts.app')
@include('layouts.menu_empresa')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	<h3 align="center">RECIBOS PENDIENTES FIRMA EMPLEADOS</h1>

	@isset($msj)
		<div class="alert alert-success" role="alert" align="center">{{ $msj }}</div>
	@endisset
	<table id="example" style="width:70%" align="center" border="2">
		<thead>
		<tr><th>Año</th><th>Mes</th><th>Cedula</th><th>Nombres</th><th>Apellidos</th><th>Ver Recibo</th></tr>
		</thead>

	@foreach ($recibos as $recibo)
		<tbody>
		<tr>
			<td>20{{  substr($recibo->id_recibo,-2,2) }}</td>
			<td>{{  substr($recibo->id_recibo,-4,2) }}</td>
			<td>{{ $recibo->cedula }}</td>
			<td>{{ $recibo->nombres }}</td>
			<td>{{ $recibo->apellidos }}</td>
			<td><a class="btn btn-primary" href="{{ url('/empresa/ver_recibo_pendiente_firma_empleado/'.$recibo->id_recibo ) }}" role="button">VER</a></td>
		</tr>
		</tbody>
	@endforeach

	</table>
<div align="center">
	<br>
	@if(isset($boton))
	<a class="btn btn-outline-info" href="{{ $recibos->previousPageUrl() }}" role="button">Anterior</a>
	<a class="btn btn-outline-info" href="{{ $recibos->nextPageUrl() }}" role="button">Siguiente</a>
	@endif
</div>
@if(isset($msj_error))
	<div class="alert alert-warning" role="alert" align="center">{{ $msj_error }}</div>
@endif
@endsection