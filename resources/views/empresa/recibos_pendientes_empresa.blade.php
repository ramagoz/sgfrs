@extends('layouts.app')
@include('layouts.menu_empresa')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
<h3 align="center">RECIBOS PENDIENTES FIRMA EMPRESA</h1>

@isset($error)
<div class="alert alert-warning" role="alert" align="center">{{ $error }}</div>
@endisset


<form action="/empresa/firma_masiva_empresa/" method="POST">
{{csrf_field()}}

<table id="example" style="width:70%" align="center" border="2">
	<thead>
	<tr><th>Año</th><th>Mes</th><th>Cedula</th><th>Nombres</th><th>Apellidos</th><th>Ver Recibo</th><th>Seleccionar</th></tr>
	</thead>

@foreach ($recibos as $recibo)
	<tbody>
	<tr>
		<td>20{{  substr($recibo->id_recibo,-2,2) }}</td>
		<td>{{  substr($recibo->id_recibo,-4,2) }}</td>
		<td>{{ $recibo->cedula }}</td>
		<td>{{ $recibo->nombres }}</td>
		<td>{{ $recibo->apellidos }}</td>
		<td><a class="btn btn-primary" href="{{ url('/empresa/ver_recibo_pendiente_firma_empresa/'.$recibo->id_recibo ) }}" role="button">VER</a></td>
		<td><input type="checkbox" name="recibos_a_firmar[]" value="{{$recibo->id_recibo}}"></td>
	</tr>
	</tbody>
@endforeach
</table>
<div align="center">
	@if(isset($boton))
		<input type="checkbox" onclick="marcar(this);" /> Marcar/Desmarcar todos
	<br>
	<a class="btn btn-outline-info" href="{{ $recibos->previousPageUrl() }}" role="button">Anterior</a>
	<a class="btn btn-outline-info" href="{{ $recibos->nextPageUrl() }}" role="button">Siguiente</a>
	<br>
	<label>Contraseña de firma: </label>
	<input type="password" name="contraseña" id="contraseña" size="15" maxlength="15" required>
	<button class="btn btn-success" type="submit">Firmar</button>
	<br>
	@endif
</div>
</form>
@if(isset($msj))
	<div class="alert alert-warning" role="alert" align="center">{{ $msj }}</div>
@endif
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
@endsection