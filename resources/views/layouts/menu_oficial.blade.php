<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/oficial">Inicio</a>
    </div>
    <ul class="nav navbar-nav">
        <li><a href="/oficial/busqueda_empresa">ABM Empresa</a></li>
        <li><a href="/oficial/busqueda_rrhh">ABM RRHH</a></li>
        <li><a href="/oficial/roles">Roles</a></li>
        <li><a href="/oficial/auditoria">Auditoria</a></li>
        <li><a href="/oficial/restablecer_contraseña">Restablecer contraseña usuario</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        @if (Session::get('rol_usuario') ==4 )
                <li><a href="/home">Cambiar de rol</a></li>
        @endif
        <li><a href="/home">Cambiar rol</a></li>
        <li><a href="/oficial/cambiar_contraseña">Cambiar contraseña</a></li>
        <li><a href="/salir"><span class="glyphicon glyphicon-log-in"></span> Salir del Sistema</a></li>
    </ul>
  </div>
</nav>