<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class corteCaja extends Model
{
    function setByRequest($obj)
    {
        $this->idCaja = $obj->idCaja;
        $this->tipo = $obj->operacion;
        $this->saldo = $obj->saldo;
        $this->diferencia = $obj->saldo - $obj->saldoCapturado;
    }
}
