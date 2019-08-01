@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_oficial')
	<h3 align="center">AUDITORIA</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Oficial de Seguridad</strong></p>

<table id="example" class="display" style="width:90%" align="center" border="1">
		<thead>
		<tr><th>Id</th><th>Fecha y Hora</th><th>Cedula</th><th>Rol</th><th>IP</th><th>Operación</th><th>Descripción</th></tr>
		</thead>

	@foreach ($registros as $registro)
		<tbody>
		<tr>
			<td>{{ $registro->id_auditoria }}</td>
			<td>{{ $registro->fecha_hora }}</td>
			<td>{{ $registro->cedula }}</td>
			<td>{{ $registro->rol }}</td>
			<td>{{ $registro->ip }}</td>
			<td>{{ $registro->operacion }}</td>
			<td><pre>{{ $registro->descripcion }}</pre></td>
		</tr>
		</tbody>
	@endforeach

</table>

@endsection