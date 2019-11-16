@extends('layouts.app')
@include('layouts.menu_empresa')
@section('content')
<div class="container-fluid">

		<div class="page-header">
		    <h2>Ver recibo pendiente de firma empresa</h2>
		</div>

		@isset($error)
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>{{ $error }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    	<span aria-hidden="true">&times;</span>
			  	</button>
			</div>
		@endisset

		<iframe src='{{$id}}' width="100%" height="75%" frameborder="0" allowfullscreen>
		</iframe><br><br>

		<form action="/empresa/firmar_recibo_empresa/" method="post">
			{{ csrf_field() }}
			<label><strong>Ingrese su contraseña de firma:</strong> </label>
			<input type="password" name="contraseña" id="contraseña" required>
			<button class="btn btn-success" type="submit">Firmar</button>
			<a class="btn btn-danger" href="{{ url('/empresa/recibos_pendientes_empresa' ) }}" role="button">Cancelar</a>
			<input type="hidden" name="id" id="id" value={{ $id_recibo }} >
		</form>
</div>
@endsection
