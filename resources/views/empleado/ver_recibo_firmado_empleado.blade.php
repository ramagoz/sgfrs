@extends('layouts.app')
@section('content')
@include('layouts.menu_empleado')

<div class="container-fluid">
<p></p>
	<div class="page-header">
	    <h2>Ver Recibo Firmado</h2>
	</div>
<p></p>
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

	<a class="btn btn-primary btn-lg" href="{{ url('/empleado/recibos_firmados' ) }}" role="button">Volver</a>

</div>
@endsection
