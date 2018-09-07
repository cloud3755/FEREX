<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Sucursal;

use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;//Prueba dataTables Ajax

class sucursalesController extends Controller
{
    public function index()
    {
        $sucursales  =  Sucursal::where('activo', true)->get();
        $estados = DB::connection("ciudades")
        ->table("estados")
        ->select("estados.*")
        ->get();
        
        return view('sucursales.sucursales', compact('sucursales', 'estados'));

    }

    public function getSucursales($activos = true)
    {
        $sucursales;
        if($activos)
            $sucursales = Sucursal::where('activo', true)->get();
        else
            $sucursales = Sucursal::all();

        return Datatables::of($sucursales)
        ->addColumn('Acciones', 
            function($sucursales) 
            {
                // return "HOLA";
                return '<a data-id="'.$sucursales->id.'" href="#" class="Editar btn btn-primary"><i class="glyphicon glyphicon-pencil"></i></a>
                 <a data-id="'.$sucursales->id.'" href="#" class="Desactivar btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>
                 <a data-id="'.$sucursales->id.'" href="#" class="Desactivar btn btn-danger"><i class="glyphicon glyphicon-barcode"></i></a>';
            })
        ->rawColumns(['Acciones'])
        ->make(true);
    }

    public function nueva(Request $request)
    {
        
    }
}
