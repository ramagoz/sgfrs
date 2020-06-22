@extends('layouts.app')
@section('content')
@include('layouts.menu_rrhh')
<div class="container" >
  <p></p>
	<div class="page-header">
	    <h2>Empleados sin Recibos</h2>
	</div>
	  <p></p>

	<table class="table table-sm compact" border="1" style="text-align: center;">
		<thead class="thead-dark" >
			<tr>
				<th>Año del periodo</th>
				<th>Mes del periodo</th>
				<th>Periodo</th>
			</tr>
		</thead>
		<tbody>
		@foreach ($periodos as $periodo)
			<tr>
				<td>{{ $periodo->año }}</td>
				<td>{{ $periodo->mes }}</td>
				<td>
					<a class="btn btn-primary btn-block" href="{{ url('/rrhh/ver_empleados_sin_recibos/'.$periodo->id_periodo ) }}" role="button">VER</a>
				</td>
			</tr>
		@endforeach
		</tbody>
	</table>

	<div class="row justify-content-center">
		<div class="col-1">
				@isset($periodos)
						{{ $periodos->links() }}
				@endisset
		</div>
	</div>
	<a class="btn btn-success"  href="{{ url('rrhh/excel/') }}" role="button">Exportar en Excel</a>

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