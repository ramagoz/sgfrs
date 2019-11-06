
<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="/empleado">Inicio</a>
    </div>
    <ul class="nav navbar-nav">
      <li><a href="/empleado/recibos_pendientes">Recibos Pendientes</a></li>
      <li><a href="/empleado/recibos_firmados">Recibos Firmados</a></li>
    </ul>
    <ul class="nav navbar-nav navbar-right">
        @if (Session::get('rol_usuario') ==2 or Session::get('rol_usuario') ==4 or Session::get('rol_usuario') ==4 or Session::get('rol_usuario') ==5)
        <li><a href="/home">Cambiar de rol</a></li>
        @endif
        <li><a href="/empleado/contactar_rrhh">Contactar con RRHH</a></li>
        <li><a href="/empleado/cambiar_contraseña">Cambiar contraseña</a></li>
        <li><a href="/salir"><span class="glyphicon glyphicon-log-in"></span> Salir del Sistema</a></li>
    </ul>
  </div>
</nav>




