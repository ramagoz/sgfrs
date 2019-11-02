@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_empleado')
	<h3 align="center">CONTACTAR CON RRHH</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Empleado</strong></p>
<div align="center">
	<table align="center" border="2">
		<tr>
			<td>
			<h2> En el caso de reclamo por algún incoveniente <br>
			 o error con los Recibos de Sueldos, favor <br>
			 contactar con la Gerencia de RRHH <br>
			 <strong>Contacto:</strong> Juan Perez <br>
			 <strong>Tel.:</strong> 021 123 456 <br>
			</td>
		</tr>
	</table>
</div>
@endsection