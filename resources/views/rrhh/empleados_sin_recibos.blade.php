@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">EMPLEADOS SIN RECIBOS</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
<div align="center">

<table id="example"  align="center" border="2">
<thead>
<tr><th WIDTH="50">ID</th><th WIDTH="50">Año</th><th WIDTH="50">Mes</th><th WIDTH="150">Seleccionar Periodo</th></tr>
</thead>
@foreach ($periodos as $periodo)
	<tbody>
	<tr>
		<td>{{ $periodo->id_periodo }}</td>
		<td>{{ $periodo->año }}</td>
		<td>{{ $periodo->mes }}</td>
		<td><a href="{{ url('/rrhh/ver_empleados_sin_recibos/'.$periodo->id_periodo) }}">Ver Periodo</a></td>
	</tr>
	</tbody>
@endforeach
</table>

	@if(isset($boton))
	<br>
	<a class="btn btn-outline-info" href="{{ $periodos->previousPageUrl() }}" role="button">Anterior</a>
	<a class="btn btn-outline-info" href="{{ $periodos->nextPageUrl() }}" role="button">Siguiente</a>
	@endif

</div>
	@if(isset($msj))
		<div class="alert alert-warning" role="alert" align="center">{{ $msj }}</div>
	@endif
@endsection