@extends('layouts.app')
@section('content')
@include('layouts.menu_rrhh')
<div class="container">
  <p></p>
	<div class="page-header">
	    <h2>Recibos Firmados por la Empresa y los Empleados</h2>
	</div>
	  <p></p>

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
						<a class="btn btn-primary btn-block" href="{{ url('/rrhh/ver_recibo_firmado_empresa_empleado/'.$recibo->id_recibo ) }}" role="button">VER</a>
					</td>
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