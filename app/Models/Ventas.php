<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ventas extends Model
{
    public function detalles()
    {
        return $this->hasMany('App\Models\ventasDetalle', 'idVenta');
    }
    public function cliente()
    {
        return $this->hasOne('App\Models\clientes', 'id', 'idCliente');
    }

    public function getTotal()
    {
        $detalles = $this->detalles;
        $sum = 0;
        foreach($detalles as $detalle)
        {
            $sum += ($detalle->cantidad * $detalle->precio);
        }
        return  $sum;
    }

}
