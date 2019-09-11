@extends('layouts.app')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	@include('layouts.menu_rrhh')
	<h3 align="center">ACTIVAR EMPLEADO</h1>
	<p align="center"><strong>Usuario: </strong> {{ Auth::user()->name }}, esta conectado con el Rol de <strong>Recursos Humanos</strong></p>
</p>

  
  </style>
<div class="container" align="center">

 <form action="{{url('/rrhh/empleado_activar')}}" id="formulario-form" method="get"  role="form"> {{ csrf_field() }}
    <div class="row justify-content-md-center">
    	@foreach($persona as $persona)
          <!--Primera columna de Carga de Datos-->
		  <div class="col-5">
				
				<div class="form-group row">
                		<label for="cedula" class="col-lg-2 col-form-label">Cédula:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="cedula" name="cedula" type="text" value="{{$persona->cedula}}" readonly> 
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="nombre" class="col-lg-2 col-form-label">Nombres:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="nombre" name="nombre" type="text" value="{{$persona->nombres}}"readonly>
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="apellido" class="col-lg-2 col-form-label">Apellidos:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="apellido" name="apellido" type="text" value="{{$persona->apellidos}}"readonly>
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="telefono" class="col-lg-2 col-form-label">Teléfono:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="telefono" name="telefono" type="text" value="{{$persona->tel}}"readonly>
                			</div>
              	</div>
             	<div class="form-group row">
                		<label for="celular" class="col-lg-2 col-form-label">Celular:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="celular" name="celular" type="text" value="{{$persona->cel}}"readonly>
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="dpto" class="col-lg-2 col-form-label">Dpto:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="dpto" name="dpto" type="text" value="{{$persona->dpto}}"readonly>
                			</div>
              	</div>
				    
		  </div>
		<!--Segunda columna de Carga de Datos -->
    	  <div class="col-md-5 col-md-offset-5">
			   <div class="form-group row">
                		<label for="cargo" class="col-lg-2 col-form-label">Cargo:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="cargo" name="cargo" type="text" value="{{$persona->cargo}}"readonly>
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="correo" class="col-lg-2 col-form-label">Correo:</label>
                			<div class="col-lg-10">
                  				<input class="form-control" id="correo" name="correo" type="email" value="{{$persona->correo}}"readonly>
                			</div>
              	</div>
              	<div class="form-group row">
                		<label for="estado" class="col-lg-2 col-form-label">Estado:</label>
                			<div class="col-lg-10">
                  				<select class="form-control" id="estado" name="estado" value="{{$persona->estado}}" readonly>
						            @if ($persona->estado==0)
                        <option value="1" selected="true">Inactivo</option>
                        @endif
                        
                        
			        			</select>
                			</div>
              	</div>

              	 <div class="form-group row">
                		<label for="grupo" class="col-lg-2 col-form-label">Grupo:</label>
                			<div class="col-lg-10" >
                  				<select class="form-control" id="grupo" name="grupo" readonly>
						                   	 @foreach($nombre_grupos as $grupo)
						                	 	@if("{{$persona->id_grupo}}"=="{{$grupo->id_grupo}}")
						            				<option value="{{$persona->id_grupo}}" selected="true" >{{$grupo->nombre_grupo}}</option>
						            			@endif
						            		@endforeach
						         
						        </select>
                			</div>
              	 </div>

              	 <div class="form-group row">
                		<label for="observacion" class="col-lg-2 col-form-label">Obs:</label>
                			<div class="col-lg-10">
                  				 <textarea class="form-control" id="observacion" name="observacion" rows="4" readonly>{{$persona->obs}} </textarea>
                			</div>
              	 </div>

		  </div>
		@endforeach
	</div>
	  <button class="btn btn-success" type="submit">Activar Usuario</button>
 </form>
</div>

@endsection


