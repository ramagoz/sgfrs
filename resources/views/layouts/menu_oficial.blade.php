<nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
<div class="container">
  <a class="navbar-brand" href="/oficial">SGFRS
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
            <a class="nav-link {{ setActive('oficial/busqueda_empresa')}}" href="/oficial/busqueda_empresa">ABM Empresa</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ setActive('oficial/busqueda_rrhh')}}" href="/oficial/busqueda_rrhh">ABM RRHH</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ setActive('oficial/roles')}}" href="/oficial/roles">Roles</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ setActive('oficial/auditoria')}}" href="/oficial/auditoria">Auditoria</a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ setActive('oficial/cambiar_contraseña')}}" href="/oficial/cambiar_contraseña">Cambiar contraseña</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/salir">Salir</a>
        </li>
    </ul>
  </div>
</div>
</nav>






