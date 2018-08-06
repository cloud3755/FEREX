<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sucursal;

class sucursalesController extends Controller
{
    public function index()
    {
        $sucursales  =  Sucursal::where('activo', true)->get();
        
        return view('sucursales.sucursales', compact('sucursales'));

    }
}
