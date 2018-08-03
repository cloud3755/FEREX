<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\interfaces\Inactivable;

class Sucursal extends Model implements Inactivable
{
   protected $table = 'sucursales';
}
