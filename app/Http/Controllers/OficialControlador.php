<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OficialControlador extends Controller
{
    public function getIndex()
    {
    	return view('oficial.index');
    }
}
