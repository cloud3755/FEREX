<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class caja extends Model
{
    public function setDefaultValues()
    {
        $this->nombre = "principal";
        $this->saldo = 0;
        $this->estado = "NI";
    }
}
