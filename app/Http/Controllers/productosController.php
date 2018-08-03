<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\Sucursal;
use Yajra\Datatables\Datatables;//Prueba dataTables Ajax

class productosController extends Controller 
{
    public function index()
    {
        $sucursales  =  Sucursal::where('activo', true);
        return view('productos.productos', compact('sucursales'));

    }

    public function get($id)
    {
        return Producto::find($id);
    } 

    public function getProductos($activos = true)
    {
        $productos;
        if($activos)
            $productos = Producto::where('activo', true);
        else
            $productos = Producto::all();

        return Datatables::of($productos)
        ->addColumn('Acciones', 
            function($productos) 
            {
                // return "HOLA";
                return '<a data-id="'.$productos->id.'" href="#" class="Editar btn  btn-primary"><i class="glyphicon glyphicon-edit"></i>Editar</a>
                 <a data-id="'.$productos->id.'" href="#" class="Desactivar btn btn-danger"><i class="glyphicon glyphicon-trash"></i>Desactivar</a>';
            })
        ->rawColumns(['Acciones'])
        ->make(true);
    }

    public function nuevo(Request $request)
    {
        try
        {
        //$prod->save();
        $producto = new Producto();
        $producto->setFields($request);
        
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
