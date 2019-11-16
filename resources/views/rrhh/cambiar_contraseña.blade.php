@extends('layouts.app')
@include('layouts.menu_rrhh')
@section('content')

<div class="container">

  <div class="page-header">
      <h2>Cambiar contraseña</h2>
  </div>

  @isset($status)
      <div class="alert alert-success" role="alert">
       <button type="button" class="close" data-dismiss="alert" aria-label="Close"  align="center"><span aria-hidden="true">&times;</span></button> {{ $status }}</div>
     <script type="text/javascript">
         window.setTimeout(function()
         {
          $(".alert").fadeTo(300, 0).slideUp(400, function(){
              $(this).remove();
          });
         }, 20000);
     </script>
     @unset($status)
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
     @unset($message)
  @endisset

  <form method="post" class="form-horizontal" role="form" action="{{url('rrhh/update_password')}}">
    {{csrf_field()}}

    <div class="centrarelemento">
      <div class="bg-white shadow rounded py-3 px-4">

        <div class="form-group row ">
          <label for="mypassword" class="col-sm-6 col-form-label">
            Introduce tu actual contraseña:
          </label>
          <div class="col-sm-6">
              <input type="password" name="mypassword" class="form-control" value="{{old('mypassword')}}" required focus>
              <div class="text-danger">
                {{$errors->first('mypassword')}}
              </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="password" class="col-sm-6 col-form-label">
            Introduce tu nueva contraseña:
          </label>
          <div class="col-sm-6">
              <input type="password" name="password" class="form-control" value="{{old('password')}}" required focus>
              <div class="text-danger">
                {{$errors->first('password')}}
              </div>
          </div>
        </div>

        <div class="form-group row">
          <label for="password" class="col-sm-6 col-form-label">
            Confirma tu nueva contraseña:
          </label>
          <div class="col-sm-6">
              <input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation')}}" required focus>
              <div class="text-danger">
                {{$errors->first('password')}}
              </div>
          </div>
        </div>
            <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
      </div>
    </div>
  </form>
</div>

@endsection