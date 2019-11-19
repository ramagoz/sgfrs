<!DOCTYPE html>
<html>
<head>
    <title>Página de ingreso al sistema</title>
    <link rel="stylesheet" type="text/css" href="{{asset('otros/bootstrap.min.css')}}" >
    <script src="{{ asset('otros/datatable/jquery.min.js') }}" defer></script>
    <script src="{{ asset('otros/js/all.js') }}" defer></script>
    <script src="{{ asset('otros/datatable/bootstrap.min.js') }}" defer></script>
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
                        <input id="email" type="email" class="form-control" placeholder="Correo electrónico" class="form-control {{ $errors->has('email') ? ' is-invalid' : '' }}"name="email" value="{{ old('email') }}" >
                    </div>
                    @if ($errors->has('email'))
                        <div class="row align-items-center remember">
                           {{ $errors->first('email') }}
                        </div>
                    @endif
                    <div class="input-group form-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                        </div>
                        <input id="password" name="password" type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Contraseña">
                    </div>
                    @if ($errors->has('password'))
                        <div class="row align-items-center remember">
                            {{ $errors->first('password') }}
                        </div>
                    @endif
                    <div class="row align-items-center remember">
                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}>Recordar mi contraseña
                    </div>
                    <div class="form-group">
                        <input type="submit" value="Ingresar" class="btn float-right login_btn">
                    </div>
                </form>
                <br>
                <div class="card-footer">
                    <div class="d-flex justify-content-center links">
                        <a href="{{ route('password.request') }}">¿Olvidaste tu contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
{{  Session::put('ip_usuario', $_SERVER['REMOTE_ADDR']) }}
</body>
</html>
