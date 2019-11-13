@extends('layouts.app')
@include('layouts.menu_empresa')
@section('content')
<div class="container-fluid">
	<div class="page-header">
	    <h2>Informes anual de gestión de recibos</h2>
	</div>

	<div>
    	<div class="mx-auto">
		    @if(isset($boton))
				<form action="/empresa/resultado_informes_empresa" method="POST">
					{{csrf_field()}}

					<div align="center" id="prueba">
					<table style="width:20%" >
							<tr>
								<th>Año:</th>
								<td>
									<select class="form-control" id="año" name="año" maxlength="4" required>
										@foreach($años as $año)
								            <option value="{{$año->año}}">
								                {{$año->año}}
								            </option>
							            @endforeach
									</select>
								</td>
							</tr>
					</table>
					<br>
							<button class="btn btn-primary" type="submit">Ver Informe</button>
					</div>
				</form>
			@endif
    	</div>
	</div>

	@if(isset($msj))
		<div class="alert alert-warning" role="alert" align="center">{{ $msj }}</div>
	@endif
</div>

@endsection