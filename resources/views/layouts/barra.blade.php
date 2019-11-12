<nav class="navbar navbar-light navbar-expand-lg bg-white shadow-sm">
<div class="container">
	<a class="navbar-brand" href="">SGFRS
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
			@if (Session::get('rol_usuario') ==1 )
	            <li class="nav-item">
			    	<a class="nav-link" href="/empleado/recibos_pendientes">Recibos Pendientes</a>
			    </li>
				<li class="nav-item">
				<a class="nav-link" href="/empleado/recibos_firmados">Recibos Firmados</a>
				</li>
			      <li class="nav-item">
			        <a class="nav-link" href="/empleado/contactar_rrhh">Contactar con RRHH</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="/empleado/cambiar_contraseña">Cambiar contraseña</a>
			      </li>
        	@endif

			@if (Session::get('rol_usuario') ==2 )
	            <li class="nav-item">
			    	<a class="nav-link" href="/empleado/recibos_pendientes">Recibos Pendientes</a>
			    </li>
				<li class="nav-item">
				<a class="nav-link" href="/empleado/recibos_firmados">Recibos Firmados</a>
				</li>
			      <li class="nav-item">
			        <a class="nav-link" href="/empleado/contactar_rrhh">Contactar con RRHH</a>
			      </li>
			      <li class="nav-item">
			        <a class="nav-link" href="/empleado/cambiar_contraseña">Cambiar contraseña</a>
			      </li>
        	@endif





			@if (Session::get('rol_usuario') ==2 or Session::get('rol_usuario') ==4 or Session::get('rol_usuario') ==4 or Session::get('rol_usuario') ==5)
		        <li>
		        	<a href="/home">Cambiar de rol</a>
		        </li>
			@endif

			<li class="nav-item">
				<a class="nav-link" href="/salir">Salir del Sistema</a>
			</li>
		</ul>
	</div>
</div>
</nav>

