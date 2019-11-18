@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')
<div class="container" >

	<div class="page-header">
	    <h2>Empleados sin recibos</h2>
	</div>

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
		<div class="alert alert-warning" role="alert" align="center">{{ $msj }}</div>
	@endisset

</div>
@endsection