@extends('layouts.app')
@section('content')
@include('layouts.menu_empleado')
<div class="container">
<p></p>
	<div class="page-header">
	    <h2>Recibos Pendientes de Firma</h2>
	</div>
<p></p>
	@isset($error)
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>{{ $error }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	@endisset

	<form action="/empleado/firma_recibos/" method="POST">
		{{csrf_field()}}
		<table class="table table-sm" border="1">
			<thead class="thead-dark">
				<tr>
					<th>Año</th>
					<th>Mes</th>
					<th>Cedula</th>
					<th>Nombres</th>
					<th>Apellidos</th>
					<th>Ver Recibo</th>
					<th>Seleccionar</th>
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
						<a class="btn btn-primary btn-block" href="{{ url('/empleado/ver_recibo_pendiente_firma_empleado/'.$recibo->id_recibo ) }}" role="button">VER</a>
					</td>
					<td>
						<div class="form-check">
								<input class="big-checkbox" type="checkbox" name="recibos_a_firmar[]" value="{{$recibo->id_recibo}}">
						</div>
					</td>
				</tr>
				</tbody>
			@endforeach
		</table>

		@if($recibos->count()>0)
			<div class="row" align="center">
				<div class="col-md-4">
					<input class="big-checkbox" type="checkbox" onclick="marcar(this);" /> Marcar/Desmarcar todos
				</div>

				<div class="col-md-4">
					{{ $recibos->links() }}
				</div>

				<div class="col-md-4">
					<label>Contraseña de firma: </label>
					<input type="password" name="contraseña" id="contraseña" size="15" maxlength="15" required>
					<button class="btn btn-success" type="submit">Firmar</button>
				</div>
			</div>
		@endif
	</form>


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