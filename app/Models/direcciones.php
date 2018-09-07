<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class direcciones extends Model
{
    public function setByRequest($request)
    {
        $this->numInterior = $request->numInterior;
        $this->numExterior = $request->numExterior;
        $this->referencia = $request->referencia;
        $this->calle = $request->calle;
        $this->entre1 = $request->entre1;
        $this->entre2 = $request->entre2;
        $this->colonia = $request->colonia;
        $this->CP = $request->CP;
        $this->ciudad = $request->ciudad;
        $this->numInterior = $request->numInterior;


    }
}
