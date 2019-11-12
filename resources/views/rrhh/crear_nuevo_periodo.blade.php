@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}

	<h3 align="center">CREAR NUEVO PERIODO</h1>
	@isset($msj)
		<div class="alert alert-success" role="alert" align="center">{{ $msj }}</div>
	@endisset
	@isset($errormsj)
		<div class="alert alert-danger" role="alert" align="center">{{ $errormsj }}</div>
	@endisset

	<form action="/rrhh/crear_nuevo_periodo" method="POST">
	{{csrf_field()}}
	<div align="center" id="prueba">
		<table style="width:20%" >
			<tr>
				<th>Mes: </th>
				<td><select name="mes" id="mes">
				   <option value="01">1- Enero</option>
				   <option value="02">2- Febrero</option>
				   <option value="03">3- Marzo</option>
				   <option value="04">4- Abril</option>
				   <option value="05">5- Mayo</option>
				   <option value="06">6- Junio</option>
				   <option value="07">7- Julio</option>
				   <option value="08">8- Agosto</option>
				   <option value="09">9- Setiembre</option>
				   <option value="10">10- Octubre</option>
				   <option value="11">11- Noviembre</option>
				   <option value="12">12- Diciembre</option>
				</select></td>
			</tr>
			<tr>
				<th>Año:</th>
				<td><input type="text" value="{{ date("Y") }}" name="año" id="año" size="4" maxlength="4" required></td>
			</tr>
		</table>
		<br>
		<button class="btn btn-primary" type="submit">Crear periodo</button>
	</div>
	<br>
	</form>
		<div align="center">
		<h4> <strong>Periodos creados</strong></h4>
		<table border="1" align="center">
		<tr><th>Mes</th><th>Año</th><th>Estado Periodo</th></tr>
		@foreach($periodos as $periodo)
		<tr>
			<td>{{ $periodo->mes }}</td>
			<td>{{ $periodo->año }}</td>
			<td>
				@if ($periodo->estado_periodo==0)
				Abierto
				@else
				Cerrado
				@endif
			</td>
		</tr>
		@endforeach
		</table>
@if(isset($boton))
<br>
<a class="btn btn-outline-info" href="{{ $periodos->previousPageUrl() }}" role="button">Anterior</a>
<a class="btn btn-outline-info" href="{{ $periodos->nextPageUrl() }}" role="button">Siguiente</a>
@endif
		</div>
@endsection