<nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
<div class="container">
  <a class="navbar-brand" href="/empresa">SGFRS
  </a>
  <button class="navbar-toggler" type="button"
    data-toggle="collapse"
    data-target="#navbarSupportedContent"
    aria-controls="#navbarSupportedContent"
    aria-expanded="false"
    aria-label="{{ __('Toggle navigation') }}">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="nav nav-pills">
        <li class="nav-item">
          <a class="nav-link {{ setActive('empresa/busqueda_oficial')}}" href="/empresa/busqueda_oficial">ABM Oficial de Seguridad</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Recibos Pendientes</a>
            <div class="dropdown-menu">
                <a class="dropdown-item {{ setActive('empresa/recibos_pendientes_empresa')}}" href="/empresa/recibos_pendientes_empresa">Recibos Pendientes Empresa</a>
                <a class="dropdown-item {{ setActive('recibos_pendientes_empleados')}}" href="/empresa/recibos_pendientes_empleados">Recibos Pendientes Empleados</a>
            </div>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ setActive('empresa/recibos_firmados_empresa_empleados')}}" href="/empresa/recibos_firmados_empresa_empleados">Recibos Firmados</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ setActive('empresa/informes_empresa')}}" href="/empresa/informes_empresa">Informes</a>
        </li>
        @if (Session::get('rol_usuario') ==4 )
            <li class="nav-item">
                <a class="nav-link" href="/home">Cambiar de rol</a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link {{ setActive('empresa/cambiar_contraseña')}}" href="/empresa/cambiar_contraseña">Cambiar contraseña</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/salir">Salir</a>
        </li>
    </ul>
  </div>
</div>
</nav>






