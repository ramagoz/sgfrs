<link href="{{ asset('css/barra.css') }}" rel="stylesheet">
<nav id='barra_menu'>
    <ul id='menu'>
        <li><a href="#">ABM Oficial de Seguridad</a>
            <ul>
                <li><a href="/empresa/busqueda_oficial">Búsqueda</a></li>
            </ul>
         </li>   
        <li><a href="#">Recibos Pendientes </a>
            <ul>
                <li><a href="/empresa/recibos_pendientes_empresa">Recibos Pendientes Empresa</a></li>
                <li><a href="/empresa/recibos_pendientes_empleados">Recibos Pendientes Empleados</a></li>
            </ul>
        </li>
        <li><a href="/empresa/recibos_firmados_empresa_empleados">Recibos Firmados</a></li> 
         <li><a href="/empresa/informes_empresa">Informes</a></li> 
         <li><a href="#">Más</a>
            <ul>
                @if (Session::get('rol_usuario') ==4 )
                <li><a href="/home">Cambiar de rol</a></li>
                @endif
                <li><a href="/empresa/cambiar_contraseña">Cambiar contraseña</a></li>
                <li><a href="/salir">Salir del Sistema</a></li>
            </ul>
         </li> 
    </ul>
</nav>

