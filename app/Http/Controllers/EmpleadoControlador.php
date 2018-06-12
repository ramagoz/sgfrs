<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpleadoControlador extends Controller
{
    public function getIndexEmpleado()
    {
    	return view('empleado.indexempleado');
    }
    public function getRecibosPendientes()
    {
    	return view('empleado.recibos_pendientes');
    }
    public function getRecibosFirmados()
    {
    	return view('empleado.recibos_firmados');
    }
    public function getContactarRrhh()
    {
    	return view('empleado.contactar_rrhh');
    }
    public function getCambiarContraseña()
    {
    	return view('empleado.cambiar_contraseña');
    }
}
