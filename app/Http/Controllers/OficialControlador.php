<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OficialControlador extends Controller
{
    public function getIndexOficial()
    {
    	return view('oficial.indexoficial');
    }
    public function getAltaRrhh()
    {
    	return view('oficial.alta_rrhh');
    }
    public function getBajaRrhh()
    {
    	return view('oficial.baja_rrhh');
    }
    public function getModificacionRrhh()
    {
    	return view('oficial.modificacion_rrhh');
    }
    public function getBusquedaRrhh()
    {
    	return view('oficial.busqueda_rrhh');
    }
    public function getAltaEmpresa()
    {
    	return view('oficial.alta_empresa');
    }
    public function getBajaEmpresa()
    {
    	return view('oficial.baja_empresa');
    }
    public function getModificacionEmpresa()
    {
    	return view('oficial.modificacion_empresa');
    }
    public function getBusquedaEmpresa()
    {
    	return view('oficial.busqueda_empresa');
    }
    public function getRoles()
    {
    	return view('oficial.roles');
    }
    public function getAuditoria()
    {
    	return view('oficial.auditoria');
    }
    public function getRestablecerContraseña()
    {
    	return view('oficial.restablecer_contraseña');
    }
    public function getCambiarContraseña()
    {
    	return view('oficial.cambiar_contraseña');
    }
}
