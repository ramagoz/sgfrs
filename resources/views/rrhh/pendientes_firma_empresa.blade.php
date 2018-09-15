@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">PENDIENTES FIRMA EMPRESA</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
	<table id="example" class="display" style="width:90%">
		<thead>
		<tr><th>Año</th><th>Mes</th><th>Cedula</th><th>Ver Recibo</th></tr>
		</thead>
	@foreach ($recibos as $recibo)
		<tbody>
		<tr>
			<td>{{ $recibo->id_recibo }}</td>
			<td>{{ $recibo->id_recibo }}</td>
			<td>{{ $recibo->id_recibo }}</td>
			<td><a class="btn btn-primary" href="{{ url('/rrhh/ver_recibo/'.$recibo->id_recibo ) }}" role="button">VER</a></td>
			<!--<td><a class="btn btn-primary" href="{{ url('/rrhh/ver_recibo' ) }}" role="button">VER</a></td>-->
		</tr>
		</tbody>
	@endforeach

	</table>



@endsection