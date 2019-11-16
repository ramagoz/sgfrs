@extends('layouts.app')
@section('content')

<div class="container-fluid">

  <div class="page-header">
      <h1>Seleccionar rol</h1>
  </div>

  <form method="post" class="form-horizontal" role="form" action="{{url('/auth/rol_seleccionado')}}">
    {{csrf_field()}}

    <div class="centrarelemento">
      <div class="bg-white shadow rounded py-3 px-4 col-12 col-sm-6 col-lg-3">
        <div class="form-group row ">
 				<label for="rol_seleccionado" class="col-sm-6 col-form-label">
             		Rol de Usuario:
          		</label>
          		<div class="col-sm-6">
	          		<select name="rol_seleccionado" id="rol_seleccionado" class="form-control ">
						@if ($rol==2)
						   <option value="rrhh">RRHH</option>
						@endif
						@if ($rol==5)
						   <option value="oficial">Oficial de Seguridad</option>
						@endif
						@if ($rol==4)
						   <option value="empresa">Empresa</option>
						@endif
						@if ($rol==1 or $rol==2 or $rol==4 or $rol==5)
						   <option value="empleado">Empleado</option>
						@endif
					</select>
				</div>
        </div>
        	<button class="btn btn-primary btn-block" type="submit">Seleccionar</button>
      </div>
    </div>
  </form>
</div>

@endsection