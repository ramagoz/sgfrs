@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}

<h3 align="center">LISTA DE RECIBOS</h1>

	@isset($msj)
		<div class="alert alert-success" role="alert" align="center">{{ $msj }}</div>
	@endisset

	<table id="example" style="width:70%" align="center" border="2">
		<thead>
		<tr><th>Año</th><th>Mes</th><th>Estado Recibo</th><th>Cedula</th><th>Nombres</th><th>Apellidos</th><th>Ver Recibo</th></tr>
		</thead>
@isset($recibos)
		@foreach ($recibos as $recibo)
		<tbody>
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
		<td><a class="btn btn-primary" href="{{ url('/rrhh/ver_recibo_a_corregir/'.$recibo->id_recibo ) }}" role="button">Ver Recibo a Corregir</a></td>
		</tbody>
		@endforeach
@endisset
	</table>

@isset($error)
	<div class="alert alert-danger" role="alert" align="center">{{ $error }}</div>
@endisset

	<div align="center">
		<br>
		@if(isset($recibos))
		<a class="btn btn-outline-info" href="{{ $recibos->previousPageUrl() }}" role="button">Anterior</a>
		<a class="btn btn-outline-info" href="{{ $recibos->nextPageUrl() }}" role="button">Siguiente</a>
		@endif
	</div>

@endsection