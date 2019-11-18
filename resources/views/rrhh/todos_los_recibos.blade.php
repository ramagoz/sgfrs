@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')
<div class="container-fluid">

	<div class="page-header">
	    <h2>Todos los recibos</h2>
	</div>

	<table class="table table-sm" border="1">
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

		@foreach ($recibos as $recibo)
			<tbody>
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
					<td><a class="btn btn-primary btn-block" href="{{ url('/rrhh/ver_todos_los_recibos/'.$recibo->id_recibo ) }}" role="button">VER</a></td>
				</tr>
			</tbody>
		@endforeach
	</table>

	<div class="row justify-content-center">
		<div class="col-1">
				@if(isset($recibos))
						{{ $recibos->links() }}
				@endif
		</div>
	</div>

	@isset($msj)
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>{{ $msj }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	@endisset

</div>
@endsection