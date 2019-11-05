@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">IMPORTAR RECIBO</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>

	@isset($msj)
		<div class="alert alert-success" role="alert" align="center">{{ $msj }}</div>
	@endisset
	@isset($errormsj)
		<div class="alert alert-danger" role="alert" align="center">{{ $errormsj }}</div>
	@endisset

	<form action="/rrhh/importar_recibos" method="POST">
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
				<td><input type="text" value="{{ date("Y") }}" name="año" id="año" size="4" maxlength="4" required=""></td>
			</tr>
		</table>
		<br>
			<button class="btn btn-primary" type="submit">Importar Recibos</button>
	</div>
	</form>

	@isset($msj)
	<br>
    <div align="center">
    <h4> Periodo Importado,  Mes: {{ $mes }} - Año: {{ $año }}</h4>
    <table border="1" align="center">
		<tr><td><strong>Total de archivos procesadoss: </strong></td><td>{{$resultados[5] }}</td></tr>
		<tr><td><strong>Cantidad de recibos correctos procesados: </strong></td><td>{{$resultados[0] }}</td></tr>
		<tr><td><strong>Cantidad de recibos con error de periodo: </strong></td><td>{{$resultados[1] }}</td></tr>
		<tr><td><strong>Cantidad de recibos con error de extension: </strong></td><td>{{$resultados[2] }}</td></tr>
		<tr><td><strong>Cantidad de recibos con número de cedula no encontrado en el sistema: </strong></td><td>{{$resultados[3] }}
		<tr><td><strong>Total de empleados del sistema sin recibos: </strong></td><td>{{$resultados[4] }}</td></tr>
		</table>
    </div>
	@endisset

@endsection