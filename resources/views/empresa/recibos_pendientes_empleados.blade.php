@extends('layouts.app')
@include('layouts.menu_empresa')
@section('content')
	<div class="container-fluid">

		<div class="page-header">
		    <h2>Recibos pendientes de firma empleados</h2>
		</div>

		<div class="table-responsive">
			<table class="table table-hover" border="1">
				<thead class="thead-dark">
					<tr>
						<th scope="col">Año</th>
						<th scope="col">Mes</th>
						<th scope="col">Cedula</th>
						<th scope="col">Nombres</th>
						<th scope="col">Apellidos</th>
						<th scope="col">Ver Recibo</th>
					</tr>
				</thead>
				@foreach ($recibos as $recibo)
					<tbody>
					<tr>
						<td>20{{  substr($recibo->id_recibo,-2,2) }}</td>
						<td>{{  substr($recibo->id_recibo,-4,2) }}</td>
						<td>{{ $recibo->cedula }}</td>
						<td>{{ $recibo->nombres }}</td>
						<td>{{ $recibo->apellidos }}</td>
						<td>
							<a class="btn btn-primary" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="{{ url('/empresa/ver_recibo_pendiente_firma_empleado/'.$recibo->id_recibo ) }}" role="button">VER</a>
						</td>
					</tr>
					</tbody>
				@endforeach
			</table>
		</div>

		<div align="center">
			@if(isset($boton))
			<a class="btn btn-outline-info" href="{{ $recibos->previousPageUrl() }}" role="button">Anterior</a>
			<a class="btn btn-outline-info" href="{{ $recibos->nextPageUrl() }}" role="button">Siguiente</a>
			@endif
		</div>

		@if(isset($msj_error))
			<div class="alert alert-warning" role="alert" align="center">{{ $msj_error }}</div>
		@endif

		@isset($msj)
			<div class="alert alert-success" role="alert" align="center">{{ $msj }}</div>
		@endisset

	</div>
@endsection