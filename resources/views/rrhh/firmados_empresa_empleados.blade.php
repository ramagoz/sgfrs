@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}

	<h3 align="center">FIRMADOS EMPRESA Y EMPLEADOS</h1>
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
			<td><a class="btn btn-primary" href="{{ url('/rrhh/ver_recibo_firmado_empresa_empleado/'.$recibo->id_recibo ) }}" role="button">VER</a></td>
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
	<a class="btn btn-outline-info" href="{{ $recibos->previousPageUrl() }}" role="button">Anterior</a>
	<a class="btn btn-outline-info" href="{{ $recibos->nextPageUrl() }}" role="button">Siguiente</a>
	@endif
</div>
@endsection