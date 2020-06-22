@extends('layouts.app')
@section('content')
@include('layouts.menu_empleado')

<div class="container">
<p></p>
		<div class="page-header">
		    <h2>Ver recibo pendiente de firma empleado</h2>
		</div>
<p></p>
		@isset($error)
			<div class="alert alert-danger alert-dismissible fade show" role="alert">
				<strong>{{ $error }}</strong>
				<button type="button" class="close" data-dismiss="alert" aria-label="Close">
			    	<span aria-hidden="true">&times;</span>
			  	</button>
			</div>
		@endisset

		<iframe src='{{$id}}' width="100%" height="350" frameborder="0" allowfullscreen>
		</iframe><br><br>

		<form action="/empleado/firmar_recibo" method="post">
			{{ csrf_field() }}
			<label><strong>Ingrese su contraseña de firma:</strong> </label>
			<input type="password" name="contraseña" id="contraseña" required>
			<button class="btn btn-success" type="submit">Firmar</button>
			<a class="btn btn-danger" href="{{ url('/empleado/recibos_pendientes' ) }}" role="button">Cancelar</a>
			<input type="hidden" name="id" id="id" value={{ $id_recibo }} >
		</form>
</div>

@endsection
