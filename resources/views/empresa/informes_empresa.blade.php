@extends('layouts.app')
@section('content')
@include('layouts.menu_empresa')
<div class="container">
<p></p>
	<div class="page-header">
    	<h2>Informes anuales de gestión de recibos</h2>
	</div>
<p></p>
	@isset($msj)
		<div class="alert alert-warning alert-dismissible fade show" role="alert">
			<strong>{{ $msj }}</strong>
			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
		    	<span aria-hidden="true">&times;</span>
		  	</button>
		</div>
	@endisset

	<br><br><br><br>
	<div class="row">
			<div class="col-12 col-sm-5 col-lg-3 mx-auto ">
			    @if(isset($boton))
					<form class="bg-white shadow rounded py-3 px-4" action="/empresa/resultado_informes_empresa" method="POST">
						{{csrf_field()}}
						<div class="form-group">
							<div class="col">
								<label for="año" class="form-control">
									Año:
								</label>
								<select class="form-control bg-ligth shadow-sm" id="año" name="año" maxlength="4" required>
									@foreach($años as $año)
							            <option value="{{$año->año}}">
							                {{$año->año}}
							            </option>
						            @endforeach
								</select>
							</div>
						</div>
						<button class="btn btn-primary" type="submit">Ver Informe</button>
					</form>
				@endif
			</div>

</div>

@endsection