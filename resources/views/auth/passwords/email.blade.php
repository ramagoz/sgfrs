<!DOCTYPE html>
<html>
<head>
    <title>Restablecer Contraseña</title>
   <!--Made with love by Mutiullah Samim -->

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <meta charset="utf-8">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>

    <!--Custom styles-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
<br><br><br><br>
<div class="container">
     <div class="d-flex justify-content-center h-150">
      <div class="card bg-secondary text-white" style="max-width: 25rem;">
        <form method="POST" action="{{ route('password.email') }}">
          @csrf
            <div class="text-center">
                  <h5><i class="fa fa-lock fa-3x"></i></h5>
                  <h2 class="text-center">¿Olvidaste tu Contraseña?</h2>
                  <p>Puedes recuperarlo aquí.</p>
                         <div class="card-body">
                           <div class="input-group form-group">
                                  <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                  </div>
                                  <input id="email" type="email" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus placeholder="Correo electrónico registrado">
                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                                    @endif
                          </div>
                         </div>
             </form>
                <div class="card-footer">
                   <div class= "input-group form-group">
                      <button type="submit" class="btn btn-success">
                          {{ __('Enviar enlace de recuperación ') }}
                      </button>
                      <div class="d-flex justify-content-center links">
                          <a href="{{ route('login') }}">Volver a la página de ingreso</a><br><br>
                      </div>
                   </div>
                    @if (session('status'))
                      <div class="alert alert-success alert-dismissible" id="myAlert" >
                         <a href="#" class="close">&times;</a>
                          {{ session('status') }}
                      </div>
                    @endif
             </div>
      </div>
    </div>
</div>

 <script>
$(document).ready(function(){
  $(".close").click(function(){
    $("#myAlert").alert("close");
  });
});
</script>

 </body>
</html>
