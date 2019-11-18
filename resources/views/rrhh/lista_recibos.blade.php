@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')
<div class="container-fluid" >

	<div class="page-header">
	    <h2>Listado de todos los recibos</h2>
	</div>

	@isset($msj)
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>{{ $msj }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	@endisset

	<table class="table table-sm compact" border="1" style="text-align: center;">
		<thead class="thead-dark" >
			<tr>
				<th>Año</th>
				<th>Mes</th>
				<th>Estado Recibo</th>
				<th>Cedula</th>
				<th>Nombres</th>
				<th>Apellidos</th>
				<th>Recibo a Corregir</th>
			</tr>
		</thead>
		@isset($recibos)
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
				<td><a class="btn btn-primary btn-block" href="{{ url('/rrhh/ver_recibo_a_corregir/'.$recibo->id_recibo ) }}" role="button">VER</a></td>
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