@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')
<div class="container-fluid">

    <div class="page-header">
        <h2>Crear nuevo periodo</h2>
    </div>

	@isset($msj)
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>{{ $msj }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	@endisset


	@isset($error)
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>{{ $error }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	@endisset

	<form action="/rrhh/crear_nuevo_periodo" method="POST">
		{{csrf_field()}}
		<div class="form-row">
				<label for="mes" class="col-sm-2 col-form-label">Mes: </label>
				<select class="col-sm-2 form-control" name="mes" id="mes">
					<option value="01">1- Enero</option>
					<option value="02">2- Febrero</option>
					<option value="03">3- Marzo</option>
					<option value="04">4- Abril</option>
					<option value="05">5- Mayo</option>
					<option value="06">6- Junio</option>
					<option value="07">7- Julio</option>
					<option value="08">8- Agosto</option>
					<option value="09">9- Setiembre</option>
					<option value="10">10- Octubre</option>
					<option value="11">11- Noviembre</option>
					<option value="12">12- Diciembre</option>
				</select>
				<label for="año" class="col-sm-2 col-form-label">Año: </label>
				<input class="col-sm-2 form-control" type="text" value="{{ date("Y") }}" name="año" id="año" size="4" maxlength="4" required>
				<label class="col-sm-2 col-form-label">Nuevo periodo: </label>
				<button class="btn btn-primary col-sm-2" type="submit">Crear</button>
		</div>
	</form>

	@isset($periodos)
		<table class="table table-sm" border="1" style="text-align: center;">
			<thead class="thead-dark">
				<tr>
					<th>Mes</th>
					<th>Año</th>
					<th>Estado Periodo</th>
				</tr>
			</thead>
			@foreach($periodos as $periodo)
				<tr>
					<td>{{ $periodo->mes }}</td>
					<td>{{ $periodo->año }}</td>
					<td>
						@if ($periodo->estado_periodo==0)
						Abierto
						@else
						Cerrado
						@endif
					</td>
				</tr>
			@endforeach
		</table>
	@endisset
	<div class="row justify-content-center">
		<div class="col-1">
				{{ $periodos->links() }}
		</div>
	</div>

</div>
@endsection