@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">VALIDAR RECIBO</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
	<br>

	<form action="/rrhh/resultado_validacion" method="POST">	
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
				<td><input type="text" value="{{ date("Y") }}" name="año" id="año" required=""></td>
			</tr>
		</table>
		<br>
			<button class="btn btn-primary" type="submit">Validar Recibos de este Periodo</button>
	</div>
	</form>


@endsection