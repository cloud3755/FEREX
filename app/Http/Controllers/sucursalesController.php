<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Yajra\Datatables\Datatables;

use App\Models\Sucursal;
use App\Models\direcciones;
use App\Models\caja;
use App\Models\sucursales_direcciones;

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

    public function get($id)
    {
    return json_encode(DB::table('sucursales')
        ->join("sucursales_direcciones", "sucursales_direcciones.idSucursal", "=", "sucursales.id")
        ->join("direcciones", "direcciones.id", "=", "sucursales_direcciones.idDireccion")
        
        ->whereRaw("sucursales.id = ".$id)
        ->select(
            "sucursales.id as idSucursal","sucursales.nombre as nombre", "direcciones.*","direcciones.id as idDireccion"
            )
        ->first());
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
                 <a data-id="'.$sucursales->id.'" href="#" class="Desactivar btn btn-danger"><i class="glyphicon glyphicon-remove"></i></a>';
            })
        ->rawColumns(['Acciones'])
        ->make(true);
    }

    public function editar(Request $request)
    {
        try
        {
        $idSucursal = $request->idSucursal;
        $idDireccion = $request->idDireccion;
        $Sucursal = Sucursal::find($idSucursal);
        $Direccion = direcciones::find($idDireccion);

        $Sucursal->nombre = $request->nombre;
        $Sucursal->save();

        $Direccion->setByRequest($request);
        $Direccion->save();

        
        \Session::flash('Guardado','Se edito la sucursal correctamente');
        return redirect()->route("Sucurslaes"); 
        }
        catch(Exception $e)
        {
            \Session::flash('Warning','Ocurrio un error en el servidor '. $e->getMessage());
            return redirect()->route("Sucurslaes"); 
        }
    }


    public function nueva(Request $request)
    {
        try
        {
        $sucursal = new Sucursal();
        $caja = new caja();
        $direcciones = new direcciones();
        $sucursales_direcciones = new sucursales_direcciones();
        
        $direcciones->setByRequest($request);
        $caja->setDefaultValues();
        $sucursal->nombre = $request->nombre;

        $sucursal->save();
        $direcciones->save();

        $caja->idSucursal =  $sucursal->id;

        $caja->save();

        $sucursales_direcciones->idSucursal =  $sucursal->id;
        $sucursales_direcciones->idDireccion = $direcciones->id;
        $sucursales_direcciones->save();
        \Session::flash('Guardado','Se Guardo la sucursal correctamente');
        return redirect()->route("Sucurslaes"); 
        }
        catch(Exception $e)
        {
            \Session::flash('Warning','Ocurrio un error en el servidor '. $e->getMessage());
            return redirect()->route("Sucurslaes"); 
        }

    }
}
