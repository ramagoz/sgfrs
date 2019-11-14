@extends('layouts.app')
@include('layouts.menu_empleado')
@section('content')
<div class="container-fluid">

	<div class="page-header">
	    <h2>Recibos firmados</h2>
	</div>

	<table class="table table-sm" border="1">
		<thead class="thead-dark">
			<tr>
				<th>Año</th>
				<th>Mes</th>
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
					<td>{{ $recibo->cedula }}</td>
					<td>{{ $recibo->nombres }}</td>
					<td>{{ $recibo->apellidos }}</td>
					<td>
						<a class="btn btn-primary btn-block" href="{{ url('/empleado/ver_recibo_firmado_empleado/'.$recibo->id_recibo ) }}" role="button">VER</a>
					</td>
				</tr>
			</tbody>
		@endforeach
	</table>
</div>

	<div class="row" align="center">
		@if(isset($recibos))
			<div class="col-md-4">
					{{ $recibos->links() }}
			</div>
		@endif
	</div>

	@isset($msj)
		<div class="alert alert-success" role="alert" align="center">
			{{ $msj }}
	</div>
	@endisset

	@isset($msj_error)
		<div class="alert alert-warning" role="alert" align="center">
			{{ $msj_error }}
	</div>
	@endisset

@endsection