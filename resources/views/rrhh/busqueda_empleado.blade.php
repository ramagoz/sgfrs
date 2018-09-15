@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">BUSQUEDA DE EMPLEADO</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
  
<body>
<div class="container" align="center">
 <div class="row justify-content-md-center">
		<div class="col-sm-8 col-sm-offset-2">
			<div class="row">

			</div>
			<div class="row">
				<a href="alta_empleado" class="btn btn-primary"><span class="glyphicon glyphicon-plus"></span>Alta de Usuario</a>
				
			</div>
			<div class="height10">
			</div>
			<div class="row">
				<table id="myTable" class="table table-bordered table-striped">
					<thead>
						<th>Cédula</th>
						<th>Nombres</th>
						<th>Telefono</th>
						<th>Correo</th>
						<th>Estado</th>
						<th>Grupo</th>
						<th>Acción</th>
					</thead>
					<tbody>

						@foreach($datos_empleados as $datos)
						<tr>
							<td>{{$datos->cedula}}</td>
							<td>{{$datos->nombres}}</td>
							<td>{{$datos->apellidos}}</td>
							<td>{{$datos->correo}}</td>
							<td>{{$datos->estado}}</td>
							<td>{{$datos->id_grupo}}</td>
							<td><a href="{{ url('rrhh/modificacion_empleado',['$id_usuario'=>$datos->id_usuario])}}" class='btn btn-success btn-sm'><span class='glyphicon glyphicon-edit'></span> Editar</a>
								<a href="baja_empleado" class='btn btn-danger btn-sm'><span class='glyphicon glyphicon-arrow-down'></span>Baja de Usuario<a>
							</td>

						 </tr>
						@endforeach
											</tbody>
				</table>
			</div>
		</div>
	</div>
</div>


</body>

</html>



@endsection