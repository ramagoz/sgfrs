@extends('layouts.app')
@include('layouts.menu_empresa')
@section('content')

	<div class="container-fluid">

		<div class="page-header">
		    <h2>Recibos firmados empresa y empleados</h2>
		</div>
		<div class="table-responsive">
			<table class="table table-hover table-sm" border="1">
				<thead class="thead-dark">
					<tr>
						<th>Año</th>
						<th>Mes</th>
						<th>Estado Recibo</th>
						<th>Cedula</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>Ver Recibo</th>
					</tr>
				</thead>
				<tbody>
					@foreach ($recibos as $recibo)
						<tr>
							<td>20{{  substr($recibo->id_recibo,-2,2) }}</td>
							<td>{{  substr($recibo->id_recibo,-4,2) }}</td>
							<td>
								@switch($recibo->id_estado_recibo)
									@case(1)
									Pendiente de Firma Empresa
									@break
									@case(2)
									Pendiente Firma Empleado
									@break
									@case(3)
									Firmado Empresa y Empleado
									@break
								@endswitch()
							</td>
							<td>{{ $recibo->cedula }}</td>
							<td>{{ $recibo->nombres }}</td>
							<td>{{ $recibo->apellidos }}</td>
							<td>
								<a class="btn btn-primary btn-block" href="{{ url('/empresa/ver_recibo_firmado_empresa_empleado/'.$recibo->id_recibo ) }}" role="button">VER</a></td>
							</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		</div>

		<div align="center">
			@if(isset($boton))
				<a class="btn btn-outline-info" href="{{ $recibos->previousPageUrl() }}" role="button">Anterior</a>
				<a class="btn btn-outline-info" href="{{ $recibos->nextPageUrl() }}" role="button">Siguiente</a>
			@endif
		</div>
		@if(isset($msj))
			<div class="alert alert-warning" role="alert" align="center">{{ $msj }}</div>
		@endif
	</div>

@endsection