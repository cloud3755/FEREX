<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\Sucursal;
use Illuminate\Support\Facades\DB;

class inventarioController extends Controller
{
    public function indexManual()
    {
        $sucursales  =  Sucursal::where('activo', true)->get();
        $productos = Producto::where('activo', true)->get();
        return view('inventario.agregarInventarioManual', compact('sucursales', 'productos'));
    }

    

    public function manual(Request $request)
    {
        $inventarios = json_decode($request->datosInventario);
        foreach($inventarios as $inventarioObject)
        {
            $inventario = new Inventario();
            if($inventario->existsBySucursal($inventarioObject->idProducto, $inventarioObject->idSucursal))
            {
                $inventario->updateAddStockBySucursalProducto($inventarioObject->idProducto, $inventarioObject->idSucursal, $inventarioObject->cantidad);
            }
            else
            {
                $inventario->idSucursal = $inventarioObject->idSucursal;
                $inventario->idProducto = $inventarioObject->idProducto;
                $inventario->cantidad = $inventarioObject->cantidad;
                $inventario->save();
                $inventario = null;
            }
            $inventario = null;
        }
        \Session::flash('Guardado','Se Guardo el inventario correctamente');
        return redirect()->route("productos"); 
        
    }
}
