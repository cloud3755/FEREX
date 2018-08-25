<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
      // se obtiene por mes el total de ventas
      $ventasMes = DB::table('ventas_detalles')
                     ->select(DB::raw('sum(precio) as suma, month(created_at) as mes'))
                     ->whereRaw('year(now()) = year(created_at)')
                     ->groupBy('mes')
                     ->get();

      // se obtine el detalle de cada cliente
      // $detalleCliente =DB::table('ventas')
      //                ->join('clientes', 'clientes.id', '=', 'ventas.idCliente')
      //                ->select(DB::raw('nombre,count(*) as total_compras,sum(total) as Compra,case when count(*) >1 then sum(limiteCredito)-((sum(limiteCredito)/count(*))) when count(*) =1 then sum(limiteCredito) end as limite'))
      //                ->groupBy('idCliente','nombre')
      //                ->get();

      return view('dashboard.dashboard',compact('ventasMes','detalleCliente'));
    }
}
