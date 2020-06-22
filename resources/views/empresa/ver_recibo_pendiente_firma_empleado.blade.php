@extends('layouts.app')
@section('content')
@include('layouts.menu_empresa')

<div class="container">
<p></p>
	<div class="page-header">
	    <h2>Ver recibo pendiente de firma empleados</h2>
	</div>
	<p></p>
<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Empresa</strong>
	@isset($msj)
		<div class="alert alert-success alert-dismissible fade show" role="alert">
			<strong>{{ $msj }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	@endisset

	<iframe src='{{$id}}' width="100%" height="350" frameborder="0" allowfullscreen>
	</iframe><br><br>

	<a class="btn btn-primary btn-lg" href="{{ url('/empresa/recibos_pendientes_empleados' ) }}" role="button">Volver</a>

</div>

@endsection

