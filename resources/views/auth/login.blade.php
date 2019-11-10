<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<!DOCTYPE html>
<html>
<head>
    <title>Página de ingreso al sistema</title>
   <!--Made with love by Mutiullah Samim -->

    <!--Bootsrap 4 CDN-->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <!--Fontawesome CDN-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

    <!--Custom styles-->
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body>
<div class="container">
    <div class="d-flex justify-content-center h-100">
        <div class="card">
            <div class="card-header">
                <h3>Sistema de Recibos Electrónicos</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('login') }}">
                @csrf
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-user"></i></span>
                        </div>
                            <input id="email" type="email" class="form-control" placeholder="Correo Electrónico" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"name="email" value="{{ old('email') }}" required autofocus>
                            @if ($errors->has('email'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('email') }}</strong>
                                        </span>
                            @endif
                    </div>
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña" name="password" required>
                        @if ($errors->has('password'))

                                        <strong>{{ $errors->first('password') }}</strong>

                        @endif
                    </div>
                    <div class="row align-items-center remember">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Recordar mi contraseña
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Ingresar" class="btn float-right login_btn">
                    </div>
                </form>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-center links">
                    <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                </div>
            </div>
        </div>
    </div>
</div>
{{  Session::put('ip_usuario', $_SERVER['REMOTE_ADDR']) }}
</body>
</html>
