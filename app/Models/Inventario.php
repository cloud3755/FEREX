<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventario extends Model
{
    public function existsBySucursal($idProducto, $idSucursal)
    {
        return !($this->getBySucursal($idProducto, $idSucursal) === null);
    }

    public  function updateAddStockBySucursalProducto($idProducto, $idSucursal, $cantidad)
    {
        $model = $this->getBySucursal($idProducto, $idSucursal);
        if($model)
        {
            $model->cantidad = $model->cantidad + $cantidad;
            $model->save();
        }
    }

    private  function getBySucursal($idProducto, $idSucursal)
    {
        return $this->where('idSucursal', '=', $idSucursal)
        ->where('idProducto', '=', $idProducto)->first();
    }

}
