<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Producto;

class productosController extends Controller
{
    public function index()
    {
        return view('productos.productos');

    }
    public function nuevo(Request $request)
    {
        try
        {
        //$prod->save();
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        //$producto->nombre = $request->nombre;
        //$producto->nombre = $request->nombre;
        $producto->save();
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
