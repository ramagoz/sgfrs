@extends('layouts.app')
@include('layouts.menu_empleado')
@section('content')
{{-- Dentro de section va el contenido de la vista--}}
	<h3 align="center">CAMBIAR CONTRASEÑA EMPLEADO</h1>

<head>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
		  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

</head>


              @isset($status)
                    <div class="alert alert-success" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"  align="center"><span aria-hidden="true">&times;</span></button> {{ $status }}</div>
                   <script type="text/javascript">
                       window.setTimeout(function() {
                                $(".alert").fadeTo(300, 0).slideUp(400, function(){
                                    $(this).remove();
                                });
                            }, 20000);
                   </script>
                   @unset($status);
                @endisset

                 @isset($message)
                    <div class="alert alert-danger" role="alert">
                     <button type="button" class="close" data-dismiss="alert" aria-label="Close"  align="center"><span aria-hidden="true">&times;</span></button> {{ $message }}</div>
                   <script type="text/javascript">
                       window.setTimeout(function() {
                                $(".alert").fadeTo(300, 0).slideUp(400, function(){
                                    $(this).remove();
                                });
                            }, 20000);
                   </script>
                   @unset($message);
                @endisset

<div class="container" align="center">
<form method="post" class="form-horizontal" role="form" action="{{url('empleado/update_password')}}">
 {{csrf_field()}}
 <div class="form-group">
    <label for="mypassword" class="col-lg-3">Introduce tu actual contraseña:</label>
       <div class="col-lg-5">
        <input type="password" name="mypassword" class="form-control">
         <div class="text-danger">{{$errors->first('mypassword')}}</div>
      </div>
 </div>
 <div class="form-group">
 	 	  <label for="password" class="col-lg-3">Introduce tu nueva contraseña:</label>
 	 <div class="col-lg-5">
		  <input type="password" name="password" class="form-control">
		  <div class="text-danger">{{$errors->first('password')}}</div>
	 </div>
 </div>
 <div class="form-group">
  <label for="mypassword" class="col-lg-3">Confirma tu nueva contraseña:</label>
      <div class="col-lg-5">
	     <input type="password" name="password_confirmation" class="form-control">
	  </div>
  </div>
 <button type="submit" class="btn btn-primary">Cambiar mi contraseña</button>
</form>
</div>

@endsection