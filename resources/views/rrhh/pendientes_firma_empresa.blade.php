@extends('layouts.app')
@section('content')
<link href="{{ asset('https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css')}}" rel="stylesheet">
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')

	<h3 align="center">PENDIENTES FIRMA EMPRESA</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>

	<table id="example" class="display" style="width:90%">
		<tr><th>Año</th><th>Mes</th><th>Cedula</th><th>Ver Recibo</th></tr>
	@foreach ($recibos as $recibo)
		<tr>
			<td>{{ $recibo->id_recibo }}</td>
			<td>{{ $recibo->id_recibo }}</td>
			<td>{{ $recibo->id_recibo }}</td>
			<td><a class="btn btn-primary" href="{{ url('/rrhh/ver_recibo/'.$recibo->id_recibo ) }}" role="button">VER</a></td>
			<!--<td><a class="btn btn-primary" href="{{ url('/rrhh/ver_recibo' ) }}" role="button">VER</a></td>-->
		</tr>
	@endforeach

	</table>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
    
 	<script type="text/javascript">
    $(document).ready(function() 
    {
    $('#example').DataTable();
    } );
	</script>

@endsection