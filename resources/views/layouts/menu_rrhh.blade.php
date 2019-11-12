<nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
<div class="container">
  <a class="navbar-brand" href="/rrhh">SGFRS
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
        <a class="nav-link" href="/rrhh/busqueda_empleado">ABM Empleados</a>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Trabajar con Recibos</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/rrhh/crear_nuevo_periodo">Crear nuevo periodo</a>
                <a class="dropdown-item" href="/rrhh/validar_recibos">Validar Recibos</a>
                <a class="dropdown-item" href="/rrhh/importar_recibos">Importar Recibos</a>
                <a class="dropdown-item" href="/rrhh/empleados_sin_recibos">Empleados sin Recibos</a>
                <a class="dropdown-item" href="/rrhh/lista_recibos">Corregir Recibos</a>
                <a class="dropdown-item" href="/rrhh/historial_recibos_corregidos">Historial Recibos Corregidos</a>
            </div>
        </li>
        <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" data-toggle="dropdown" href="#">Ver Recibos</a>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/rrhh/pendientes_firma_empresa">Pendientes Firma Empresa</a>
                <a class="dropdown-item" href="/rrhh/pendientes_firma_empleados">Pendientes Firma Empleados</a>
                <a class="dropdown-item" href="/rrhh/firmados_empresa_empleados">Firmados Empresa y Empleados</a>
                <a class="dropdown-item" href="/rrhh/todos_los_recibos">Todos los Recibos</a>
            </div>
        </li>
        <li class="nav-item">
        <a class="nav-link" href="/rrhh/informes_rrhh">Informes</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/home">Cambiar de rol</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/rrhh/cambiar_contraseña">Cambiar contraseña</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="/salir">Salir del Sistema</a>
        </li>
    </ul>
  </div>
</div>
</nav>






