<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpresaControlador extends Controller
{
    public function getIndexEmpresa()
    {
    	return view('empresa.indexempresa');
    }
}
