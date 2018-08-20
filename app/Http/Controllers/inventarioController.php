<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\Sucursal;

class inventarioController extends Controller
{
    public function manual()
    {
        $sucursales  =  Sucursal::where('activo', true)->get();
        $productos = Producto::where('activo', true)->get();
        return view('inventario.agregarInventarioManual', compact('sucursales', 'productos'));

    }
}
