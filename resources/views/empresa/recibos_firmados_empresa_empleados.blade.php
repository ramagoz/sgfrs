@extends('layouts.app')
@include('layouts.menu_empresa')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}

	<h3 align="center">RECIBOS FIRMADOS EMPRESA Y EMPLEADOS</h1>

<table id="example" style="width:70%" align="center" border="2">
	<thead>
	<tr><th>Año</th><th>Mes</th><th>Estado Recibo</th><th>Cedula</th><th>Nombres</th><th>Apellidos</th><th>Ver Recibo</th></tr>
	</thead>
	<tbody>
	@foreach ($recibos as $recibo)
	<tr>
		<td>20{{  substr($recibo->id_recibo,-2,2) }}</td>
		<td>{{  substr($recibo->id_recibo,-4,2) }}</td>
		<td>
			@switch($recibo->id_estado_recibo)
				@case(1)
				Pendiente de Firma Empresa
				@break
				@case(2)
				Pendiente Firma Empleado
				@break
				@case(3)
				Firmado Empresa y Empleado
				@break
			@endswitch()
		</td>
		<td>{{ $recibo->cedula }}</td>
		<td>{{ $recibo->nombres }}</td>
		<td>{{ $recibo->apellidos }}</td>
		<td><a class="btn btn-primary" href="{{ url('/rrhh/ver_todos_los_recibos/'.$recibo->id_recibo ) }}" role="button">VER</a></td>
	</tr>
	@endforeach

	</tbody>
</table>
<div align="center">
	@if(isset($boton))
	<br>
	<a class="btn btn-outline-info" href="{{ $recibos->previousPageUrl() }}" role="button">Anterior</a>
	<a class="btn btn-outline-info" href="{{ $recibos->nextPageUrl() }}" role="button">Siguiente</a>
	@endif
</div>
@if(isset($msj))
	<div class="alert alert-warning" role="alert" align="center">{{ $msj }}</div>
@endif
@endsection