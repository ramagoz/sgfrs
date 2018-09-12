@extends('layouts.app')
@section('content')


<script type="text/javascript">
    
    $(document).ready(function() 
    {
    $('#example').DataTable();
    } );

</script>
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
			<td>Enlace</td>
		</tr>
	@endforeach

	</table>
@endsection