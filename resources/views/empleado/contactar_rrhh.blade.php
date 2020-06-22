@extends('layouts.app')
@section('content')
@include('layouts.menu_empleado')

<div class="container-fluid">

	<div class="page-header">
    	<h2>Contactar con RRHH</h2>
	</div>
	<br><br><br>
	<div class="row">
		<div class="col-10 col-sm-8 col-lg-10 mx-auto m-auto bg-white shadow rounded py-3 px-4">
			<div class="form-group">
				<div class="col">
					<table>
						<tr>
							<td>
							<h2> En el caso de reclamo por algún incoveniente u error con los Recibos de Sueldos, favor contactar con la Gerencia de RRHH.<br>
							 <strong>Contacto:</strong> Juan Perez <br>
							 <strong>Tel.:</strong> 021 123 456 <br>
							</td>
						</tr>
					</table>
				</div>
			</div>
		</div>
	</div>

</div>

@endsection