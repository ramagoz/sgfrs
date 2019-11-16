@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')

<div class="container-fluid">

	<div class="page-header">
	    <h2>Ver recibo pendiente de firma empresa</h2>
	</div>

	<iframe src='{{$id}}' width="100%" height="75%" frameborder="0" allowfullscreen>
	</iframe><br><br>

	<a class="btn btn-primary btn-lg" href="{{ url('/rrhh/pendientes_firma_empresa' ) }}" role="button">Volver</a>

</div>

@endsection