@extends('layouts.app')
@section('content')
@include('layouts.menu_empresa')
<div class="container">
  <p></p>
  <div class="page-header">
      <h2>Cambiar contraseña</h2>
  </div>  <p></p>
  @isset($msj)
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      <strong>{{ $msj }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @endisset

  @isset($error)
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      <strong>{{ $error }}</strong>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>
  @endisset

  <form method="post" class="form-horizontal" role="form" action="{{url('empresa/update_password')}}">
    {{csrf_field()}}

    <div class="centrarelemento">
      <div class="bg-white shadow rounded py-3 px-4">

        <div class="form-group row ">
          <label for="mypassword" class="col-sm-6 col-form-label">
            Introduce tu actual contraseña:
          </label>
          <div class="col-sm-6">
              <input type="password" name="mypassword" class="form-control" value="{{old('mypassword')}}" required focus maxlength="18" minlength="4">
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
              <input type="password" name="password" class="form-control" value="{{old('password')}}" required focus maxlength="18" minlength="4">
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
              <input type="password" name="password_confirmation" class="form-control" value="{{old('password_confirmation')}}" required focus maxlength="18" minlength="4">
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