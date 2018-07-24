<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Inventario;

use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos =  DB::table('inventarios')
        ->join('productos', "inventarios.idProducto", "=", "productos.id")
        ->where('inventarios.cantidad', '<', 'productos.minimoAlarma')
        ->select("productos.nombre" , "productos.descripcion", "inventarios.cantidad as stock", "productos.minimoAlarma as alarma" )
        
        ->get();
//dd($productos);
        return view('home' , compact('productos'));
    }
}
