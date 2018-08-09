<?php

namespace App\Http\Controllers;

use App\Models\clientes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Producto;
use App\Models\Inventario;
use Yajra\Datatables\Datatables;//Prueba dataTables Ajax

class ventaController extends Controller
{


    public function index()
    {
        $productos = new Producto();
        $productos = $productos->all();

        $clientes = new clientes();
        $clientes = $clientes->all();
        return view('ventas.venta', compact('productos'),compact("clientes"));

    }

}
