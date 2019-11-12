@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
<h3 align="center">Ver Recibo Corregido</h1>

<div align="center">
	<iframe src='{{$url}}' width="70%" height="350" style="border: none;" ></iframe>
	<br>
	<a class="btn btn-primary" href="{{ url('/rrhh/historial_recibos_corregidos' ) }}" role="button">Volver</a>
</div>

@endsection
