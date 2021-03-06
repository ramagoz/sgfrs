<nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
<div class="container">
  <a class="navbar-brand" href="/empleado">SGFRS
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
        <a class="nav-link {{ setActive('empleado/recibos_pendientes')}}" href="/empleado/recibos_pendientes">Recibos Pendientes</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ setActive('empleado/recibos_firmados')}}" href="/empleado/recibos_firmados">Recibos Firmados</a>
      </li>
      @if (Session::get('rol_usuario') ==2 or Session::get('rol_usuario') ==4 or Session::get('rol_usuario') ==5)
        <li lass="nav-item">
          <a class="nav-link" href="/home">Cambiar de rol</a>
        </li>
      @endif
      <li class="nav-item">
        <a class="nav-link {{ setActive('empleado/contactar_rrhh')}}" href="/empleado/contactar_rrhh">Contactar con RRHH</a>
      </li>
      <li class="nav-item">
        <a class="nav-link {{ setActive('empleado/cambiar_contraseña')}}" href="/empleado/cambiar_contraseña">Cambiar contraseña</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/salir">Salir</a>
      </li>
    </ul>
  </div>
</div>
</nav>




