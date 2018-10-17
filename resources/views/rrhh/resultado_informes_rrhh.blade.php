@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">INFORMES PARA RRHH</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
	<table id="example" class="display" style="width:90%" align="center" border="1">
		<thead>
		<tr><th>Año</th><th>Mes</th><th>Total Recibos</th><th>Firmados Empresa</th><th>Pendientes Firma Empresa</th><th>Firmados Empleados</th><th>Pendientes Firma Empleados</th><th>Estado Periodo</th></tr>
		</thead>

		<tbody>
				
		</tbody>

	</table>

@endsection