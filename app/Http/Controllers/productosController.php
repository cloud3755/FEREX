<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Inventario;
use App\Models\Sucursal;
use Yajra\Datatables\Datatables;//Prueba dataTables Ajax 
use Excel;
use App\Jobs\ProcesCargaProductos;
use File;
use Illuminate\Support\Facades\Input;


class productosController extends Controller 
{

    public function prueba()
    {
        return view("prueba");
    }
    public function index()
    {
        $sucursales  =  Sucursal::where('activo', true)->get();
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
            $productos = Producto::where('activo', true)->get();
        else
            $productos = Producto::all();

        return  Datatables::of($productos)
        ->addColumn('Acciones', 
            function($productos) 
            {
                // return "HOLA";
                return '<a data-id="'.$productos->id.'" href="#" class="Editar btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                 <a data-id="'.$productos->id.'" href="#" class="Desactivar btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
            })
            
            ->addColumn('codigoBarras', 
            function($productos) 
            {
                // return "HOLA";
                return '<a data-code="'.$productos->codigoBarras.'" href="#" data-toggle="modal" data-target="#modalBarras" class="codigoBarras btn btn-default"><i class="glyphicon glyphicon-barcode"></i></a> '.$productos->codigoBarras;
            })
            ->addColumn('Existencias',
            function($productos)
            {
                $inventario = DB::table("inventarios")
                ->join("sucursales", "sucursales.id","=" ,"inventarios.idSucursal")
                ->whereRaw("inventarios.idProducto=". $productos->id)
                ->select("sucursales.nombre", "inventarios.cantidad")->get();
              // dd($inventario);
                $strDatos = "";
                foreach($inventario as $inv)
                {
                    $strDatos .="<span>".$inv->nombre." ".$inv->cantidad."</span>";
                }
                return $strDatos;
            }) 
        ->rawColumns(['Acciones', 'codigoBarras', 'Existencias'])
        ->make(true);
    }

    public function nuevo(Request $request)
    {
        try
        {
        //dd($request);
        $producto = new Producto();
        $producto->setFields($request);
        $producto->save(); 

        $inventarioInicial = json_decode($request->dataInventarioInicial);

        foreach($inventarioInicial as $key=>$val)
        {
            $inventario = new Inventario();
            $inventario->idSucursal = $key;
            $inventario->idProducto = $producto->id;
            $inventario->cantidad = $val;
            $inventario->save();
            $inventario = null;
        }
        \Session::flash('Guardado','Se Guardo el producto correctamente');
        return redirect()->route("productos"); 
        }
        catch(Exception $e)
        {
            \Session::flash('Warning','Ocurrio un error en el servidor '. $e->getMessage());
            return redirect()->route("productos"); 
        }
    }

    public function editar(Request $request)
    {
        try
        {
        $idProducto = $request->idProducto;
        $producto = Producto::find($idProducto);
        $producto->setFields($request);
        $producto->save();
        \Session::flash('Guardado','Se edito el producto correctamente');
        return redirect()->route("productos"); 
        }
        catch(Exception $e)
        {
            \Session::flash('Warning','Ocurrio un error en el servidor '. $e->getMessage());
            return redirect()->route("productos"); 
        }
    }

    public function cambioEstatus(Request $request)
    {
        $idProducto = $request->idProducto;
        $producto = Producto::find($idProducto);
        $producto->activo = !($producto->activo);
        $producto->save();
        \Session::flash('Guardado','Se desactivo el producto correctamente');
        return redirect()->route("productos"); 
    }

    public function crearDescargarLayoutExcelCargaMasiva()
    {
        return Excel::create('Layout Carga masiva', function($excel) {
 
            $excel->sheet('Productos', function($sheet) {

                $sheet->fromArray($this->headings());
 
            });
        })->export('xls');
    }

    private function headings(): array
    {
        $sucursales  =  Sucursal::where('activo', true)->get();
        $sucursalesArray = [];
        foreach($sucursales as $sucursal)
        {
            array_push( $sucursalesArray, "sucursal"." ". $sucursal->id." ".$sucursal->nombre);
        }
        return array_merge( [
            'Producto',
            'Descripcion',
            'Clave SAT',
            'Precio A',
            'Precio B',
            'Precio C',
            'Codigo Barras',
        ], $sucursalesArray);
    }

    public function masiveUpload(Request $request)
    {

        $path = Input::file('layout')->getRealPath();
    //    $data = Excel::load($path, function($reader) {})->get();
    //        dd($data);return;
        ProcesCargaProductos::dispatch($path);
        \Session::flash('Guardado','Se estan cargando sus productos');
        return redirect()->route("productos"); 
        
        
    }
}
