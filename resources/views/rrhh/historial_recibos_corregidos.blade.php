@extends('layouts.app')
@section('content')
@include('layouts.menu_rrhh')
<div class="container">
  <p></p>
	<div class="page-header">
	    <h2>Historial de Recibos Corregidos</h2>
	</div>
	  <p></p>

	<table class="table table-sm compact" border="1" style="text-align: center;">
		@isset($recibos)
			<thead class="thead-dark" >
				<tr>
					<th>Fecha Corrección</th>
					<th>Motivo Correción</th>
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
				<td>{{ $recibo->fecha_hora}}</td>
				<td>{{ $recibo->motivo_error }}</td>
				<td>20{{  substr($recibo->id_recibo,-2,2) }}</td>
				<td>{{  substr($recibo->id_recibo,-4,2) }}</td>
				<td>{{ $recibo->cedula }}</td>
				<td>{{ $recibo->nombres }}</td>
				<td>{{ $recibo->apellidos }}</td>
				<td><a class="btn btn-primary btn-block" href="{{ url('/rrhh/ver_recibo_corregido/'.$recibo->id ) }}" role="button">VER</a></td>
				</tbody>
				@endforeach
		@endisset
	</table>

	@isset($error)
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>{{ $error }}</strong>
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

</div>
@endsection