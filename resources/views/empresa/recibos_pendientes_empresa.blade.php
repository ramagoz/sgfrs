@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_empresa')
	<h3 align="center">RECIBOS PENDIENTES FIRMA EMPRESA</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Empresa</strong></p>

	<form action="/empresa/recibos_pendientes_empleados/" method="POST">
	{{csrf_field()}}
	<table id="example" class="display" style="width:90%" align="center" border="1">
		<thead>
		<tr><th>Año</th><th>Mes</th><th>Cedula</th><th>Nombres</th><th>Apellidos</th><th>Ver Recibo</th><th>Seleccionar</th></tr>
		</thead>
	
	@foreach ($recibos as $recibo)
		<tbody>
		<tr>
			<td>20{{  substr($recibo->id_recibo,-2,2) }}</td>
			<td>{{  substr($recibo->id_recibo,-4,2) }}</td>
			<td>{{ $recibo->cedula }}</td>
			<td>{{ $recibo->nombres }}</td>
			<td>{{ $recibo->apellidos }}</td>
			<td><a class="btn btn-primary" href="{{ url('/empresa/ver_recibo_pendiente_firma_empresa/'.$recibo->id_recibo ) }}" role="button">VER</a></td>
			<td><input type="checkbox" name="recibos_a_firmar[]" value="{{$recibo->id_recibo}}"></td>
		</tr>
		</tbody>
	@endforeach
	</table>
	<br>
	<div align="center">
	@if(isset($msj))
		<div class="alert alert-warning" role="alert" align="center">{{ $msj }}</div>
	@endif
	@if(isset($boton))
		<button class="btn btn-success" type="submit">Firmar</button>
	@endif
	</div>

	</form>
@endsection