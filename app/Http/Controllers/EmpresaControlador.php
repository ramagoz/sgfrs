<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EmpresaControlador extends Controller
{
    public function getIndex()
    {
    	return view('empresa.index');
    }
}
