<link href="{{ asset('css/barra3.css') }}" rel="stylesheet">
<nav id='barra_menu'>
    <ul id='menu'>
        <li><a href="/empleado/recibos_pendientes">Recibos Pendientes</a></li>   
        <li><a href="/empleado/recibos_firmados">Recibos Firmados</a></li>
        <li><a href="/empleado/contactar_rrhh">Contactar con RRHH</a></li>
        <li><a href="#">Más</a>
            <ul>
            	@if (Session::get('rol_usuario') ==2 or Session::get('rol_usuario') ==4 or Session::get('rol_usuario') ==4 or Session::get('rol_usuario') ==5)
                <li><a href="/home">Cambiar de rol</a></li>
                @endif
                <li><a href="/empleado/cambiar_contraseña">Cambiar contraseña</a></li>
                <li><a href="/salir">Salir del Sistema</a></li>
            </ul>
         </li> 
    </ul>
</nav>

