<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Auth;

class corteCaja extends Model
{
    function setByRequest($obj)
    {
        $this->idCaja = $obj->idCaja;
        $this->tipo = $obj->operacion;
        $this->saldoSistema = $obj->saldo;
        $this->saldoCapturado =  $obj->saldoCapturado;
        $this->idUsuario = Auth::user()->id;
    }
}
