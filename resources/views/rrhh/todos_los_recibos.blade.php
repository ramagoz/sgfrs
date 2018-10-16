@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">TODOS LOS RECIBOS</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
	<table id="example" class="display" style="width:90%" align="center" border="1">
		<thead>
		<tr><th>Año</th><th>Mes</th><th>Estado Recibo</th><th>Cedula</th><th>Nombres</th><th>Apellidos</th><th>Ver Recibo</th></tr>
		</thead>
	
	@foreach ($recibos as $recibo)
		<tbody>
		<tr>
			<td>20{{  substr($recibo->id_recibo,-2,2) }}</td>
			<td>{{  substr($recibo->id_recibo,-4,2) }}</td>
			<td>
			@switch($recibo->id_estado_recibo)
				@case(2)
				Pendiente de Firma Empresa
				@break
				@case(3)
				Pendiente Firma Empleado
				@break
				@case(4)
				Firmado Empresa y Empleado
				@break
			@endswitch()
			</td>
			<td>{{ $recibo->cedula }}</td>
			<td>{{ $recibo->nombres }}</td>
			<td>{{ $recibo->apellidos }}</td>
			<td><a class="btn btn-primary" href="{{ url('/rrhh/ver_todos_los_recibos/'.$recibo->id_recibo ) }}" role="button">VER</a></td>
		</tr>
		</tbody>
	@endforeach

	</table>


@endsection