@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">CREAR NUEVO PERIODO</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
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
				   <option value="01">Enero</option> 
				   <option value="02">Febrero</option> 
				   <option value="03">Marzo</option>
				   <option value="04">Abril</option> 
				   <option value="05">Mayo</option> 
				   <option value="06">Junio</option>
				   <option value="07">Julio</option> 
				   <option value="08">Agosto</option> 
				   <option value="09">Setiembre</option>
				   <option value="10">Octubre</option> 
				   <option value="11">Noviembre</option> 
				   <option value="12">Diciembre</option>
				</select></td>
			</tr>
			<tr> 
				<th>Año:</th>
				<td><input type="text" value="{{ date("Y") }}" name="año" id="año" size="12" maxlength="4" required></td>
			</tr>
			<br>
			<tr>
				<td colspan="2" align="center"><button class="btn btn-primary" type="submit">Crear periodo</button></td>
			</tr>
		</table>
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