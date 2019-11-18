@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')
<div class="container-fluid">

	<div class="page-header">
	    <h2>Ver recibo corregido</h2>
	</div>

	<iframe src='{{$url}}' width="100%" height="75%" frameborder="0" allowfullscreen>
		</iframe><br><br>
	<a class="btn btn-primary btn-lg" href="{{ url('/rrhh/historial_recibos_corregidos' ) }}" role="button">Volver</a>

</div>
@endsection
