@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')
<div class="container-fluid" >

	<div class="page-header">
	    <h2>Empleados con recibos pendientes de importación</h2>
	</div>

	@isset($datos)
		<table class="table table-sm compact" border="1" style="text-align: center;">
			<thead class="thead-dark" >
				<tr>
					<th>Cedula</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Mes</th>
					<th>Año</th>
				</tr>
			</thead>
			@foreach ($datos as $dato)
				<tbody>
				<tr>
					<td>{{ $dato->cedula }}</td>
					<td>{{$dato->nombres}}</td>
					<td>{{$dato->apellidos}}</td>
					<td>{{  $mes }}</td>
					<td>{{  $año }}</td>
				</tr>
				</tbody>
			@endforeach
		</table>
	@endisset

	@isset($msj)
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>{{ $msj }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	@endisset

	<div class="row justify-content-center">
		<div class="col-1">
				@isset($periodos)
						{{ $periodos->links() }}
				@endisset
		</div>
	</div>

	<a class="btn btn-primary btn-lg" href="{{ url('/rrhh/empleados_sin_recibos' ) }}" align="center">Volver</a>

</div>
@endsection