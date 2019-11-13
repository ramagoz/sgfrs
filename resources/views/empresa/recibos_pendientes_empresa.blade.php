@extends('layouts.app')
@include('layouts.menu_empresa')
@section('content')

	<div class="container-fluid">

		<div class="page-header">
		    <h2>Recibos pendientes de firma empresa</h2>
		</div>

		<form action="/empresa/firma_masiva_empresa/" method="POST">
			{{csrf_field()}}
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
							<th scope="col">Seleccionar</th>
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
								<a class="btn btn-primary" data-toggle="collapse" aria-expanded="false" aria-controls="collapseExample" href="{{ url('/empresa/ver_recibo_pendiente_firma_empresa/'.$recibo->id_recibo ) }}" role="button">VER</a></td>
							<td>
								<div class="form-check">
									<input type="checkbox" name="recibos_a_firmar[]" value="{{$recibo->id_recibo}}">
								</div>
							</td>
						</tr>
						</tbody>
					@endforeach
				</table>
			</div>
			@if(isset($boton))
				<div class="row">
					<div class="col-md-4">
						<input type="checkbox" onclick="marcar(this);" /> Marcar/Desmarcar todos
					</div>
					<div class="col-md-4">
						<a class="btn btn-outline-info" href="{{ $recibos->previousPageUrl() }}" role="button">Anterior</a>
						<a class="btn btn-outline-info" href="{{ $recibos->nextPageUrl() }}" role="button">Siguiente</a>
					</div>
					<div class="col-md-4">
						<label>Contraseña de firma: </label>
						<input type="password" name="contraseña" id="contraseña" size="15" maxlength="15" required>
						<button class="btn btn-success" type="submit">Firmar</button>
					</div>
				</div>
			@endif
		</form>

		@if(isset($msj))
			<div class="alert alert-warning" role="alert" align="center">{{ $msj }}</div>
		@endif

		@isset($error)
		<div class="alert alert-warning" role="alert" align="center">{{ $error }}</div>
		@endisset

@endsection

<script type="text/javascript">
	function marcar(source)
	{
		checkboxes=document.getElementsByTagName('input'); //obtenemos todos los controles del tipo Input
		for(i=0;i<checkboxes.length;i++) //recoremos todos los controles
		{
			if(checkboxes[i].type == "checkbox") //solo si es un checkbox entramos
			{
				checkboxes[i].checked=source.checked; //si es un checkbox le damos el valor del checkbox que lo llamó (Marcar/Desmarcar Todos)
			}
		}
	}
</script>