@extends('layouts.app')
@include('layouts.menu_empresa')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	<h3 align="center">RECIBOS FIRMADOS EMPRESA</h1>
<div align="center">
<iframe src='{{$id}}' width="1200" height="400" style="border: none;" ></iframe>
<br>
<a class="btn btn-primary" href="{{ url('/empresa/recibos_firmados_empresa_empleados' ) }}" role="button">Volver</a>
</div>
@endsection
