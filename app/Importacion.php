<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Importacion extends Model
{
	 protected $table = 'importaciones';
     protected $primaryKey = 'id_importacion';
     public $timestamps = false;

}
