<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Periodo extends Model
{
	 protected $table = 'periodos';
     protected $primaryKey = 'id_periodo';
     public $timestamps = false;

}
