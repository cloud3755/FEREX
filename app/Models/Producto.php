<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\interfaces\Inactivable;

class Producto extends Model implements Inactivable
{
    function setFields($request)
    {
        $this->nombre = $request->nombre;
        $this->descripcion = $request->descripcion;
        $this->claveProdServ = $request->claveProdServ;
        $this->minimoAlarma = $request->minimoAlarma;
        $this->codigoBarras = $request->codigoBarras;
        $this->precioA = $request->precioA;
        $this->precioB = $request->precioB;
        $this->precioC = $request->precioC;
        $this->Costo = $request->Costo;
        $this->urlImagen = $request->urlImagen;
    }

    public function sucursales() {
        return $this->belongsToMany('App\Models\Sucursal', 'inventarios', 'idProducto', 'idSucursal')->withPivot('cantidad');
    }
}
