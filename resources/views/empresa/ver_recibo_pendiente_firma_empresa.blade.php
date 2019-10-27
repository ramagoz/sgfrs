@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_empresa')
	<h3 align="center">VER RECIBO PENDIENTE FIRMA EMPRESA</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Empresa</strong></p>
@isset($error)
		<div class="alert alert-warning" role="alert" align="center">{{ $error }}</div>
@endisset

<div align="center">
<iframe src='{{$id}}' width="1200" height="400" style="border: none;" ></iframe>
<br>
<a class="btn btn-primary" href="{{ url('/empresa/recibos_pendientes_empresa' ) }}" role="button">Volver</a>
<a class="btn btn-success" href="{{ url('/empresa/ver_recibo_firmado_empresa/'.$id_recibo) }}" role="button">Firmar</a>
</div>
@endsection
