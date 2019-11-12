@extends('layouts.app')
@include('layouts.menu_empleado')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	<h3 align="center">VER RECIBO</h1>

	@isset($error)
			<div class="alert alert-warning" role="alert" align="center">{{ $error }}</div>
	@endisset

<div align="center">
<iframe src='{{$id}}' width="1200" height="400" style="border: none;" ></iframe>
<br>
<!--
<a class="btn btn-primary" href="{{ url('/empleado/recibos_pendientes' ) }}" role="button">Volver</a>
<a class="btn btn-success" href="{{ url('/empleado/ver_recibo_firmado_empleado/'.$id_recibo) }}" role="button">Firmar</a>
-->
<form action="/empleado/firmar_recibo/" method="post">
		{{ csrf_field() }}
		<label>Ingrese su contraseña de firma: </label>
		<input type="password" name="contraseña" id="contraseña" required>
		<button class="btn btn-success" type="submit">Firmar</button>
		<a class="btn btn-primary" href="{{ url('/empleado/recibos_pendientes' ) }}" role="button">Volver</a>
		<input type="hidden" name="id" id="id" value={{ $id_recibo }} >
</form>

</div>
@endsection
