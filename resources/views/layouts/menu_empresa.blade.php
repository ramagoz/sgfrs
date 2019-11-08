<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/empresa/inicio">Inicio</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="/empresa/busqueda_oficial">ABM Oficial de Seguridad</a></li>
        <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Recibos Pendientes<span class="caret"></span></a>
                <ul class="dropdown-menu">
                    <li><a href="/empresa/recibos_pendientes_empresa">Recibos Pendientes de Firma Empresa</a></li>
                    <li><a href="/empresa/recibos_pendientes_empleados">Recibos Pendientes de Firma Empleados</a></li>
                </ul>
        </li>
        <li><a href="/empresa/recibos_firmados_empresa_empleados">Recibos Firmados</a></li>
        <li><a href="/empresa/informes_empresa">Informes</a></li>
    </ul>

    <ul class="nav navbar-nav navbar-right">
        @if (Session::get('rol_usuario') ==4 )
                <li><a href="/home">Cambiar de rol</a></li>
        @endif
        <li><a href="/empresa/cambiar_contraseña">Cambiar contraseña</a></li>
        <li><a href="/salir"><span class="glyphicon glyphicon-log-in"></span> Salir del Sistema</a></li>
    </ul>
  </div>
</nav>

