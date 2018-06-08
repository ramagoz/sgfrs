<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OficialControlador extends Controller
{
    public function getIndexOficial()
    {
    	return view('oficial.indexoficial');
    }
}
