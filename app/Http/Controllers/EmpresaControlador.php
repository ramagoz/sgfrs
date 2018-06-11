<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpresaControlador extends Controller
{
    public function getIndexEmpresa()
    {
    	return view('empresa.indexempresa');
    }
    public function getAltaOficial()
    {
    	return view('empresa.alta_oficial');
    }
     public function getBajaOficial()
    {
    	return view('empresa.baja_oficial');
    }
     public function getModificacionOficial()
    {
    	return view('empresa.modificacion_oficial');
    }
     public function getBusquedaOficial()
    {
    	return view('empresa.busqueda_oficial');
    }
     public function getRecibosPendientesEmpresa()
    {
    	return view('empresa.recibos_pendientes_empresa');
    }
     public function getRecibosPendientesEmpleados()
    {
    	return view('empresa.recibos_pendientes_empleados');
    }
     public function getRecibosFirmadosEmpresa()
    {
    	return view('empresa.recibos_firmados_empresa');
    }
     public function getInformesEmpresa()
    {
    	return view('empresa.informes_empresa');
    }
     public function getCambiarContraseña()
    {
    	return view('empresa.cambiar_contraseña');
    }

}
