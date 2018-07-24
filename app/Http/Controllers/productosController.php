<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Inventario;

class productosController extends Controller
{
    public function index()
    {
        $productos = new Producto();
        $productos = $productos->all();
        return view('productos.productos', compact('productos'));

    }
    public function nuevo(Request $request)
    {
        try
        {
        //$prod->save();
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        
        $producto->claveProdServ = $request->claveProdServ;
        $producto->minimoAlarma = $request->minimoAlarma;
        $producto->codigoBarras = $request->codigoBarras;
        
        $inicial = $request->inicial;
        
        $producto->save();
        $inventario = new Inventario();
        $inventario->idSucursal = 1;
        $inventario->idProducto = $producto->id;
        $inventario->cantidad = $inicial;
        $inventario->save();
        \Session::flash('Guardado','Se Guardo el número de parte correctamente');
        return redirect()->route("productos"); 
        }
        catch(Exception $e)
        {
            \Session::flash('Warning','Ocurrio un error en el servidor '. $e->getMessage());
            return redirect()->route("productos"); 
        }
    }
}
