<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

      $ventasMes = DB::table('ventas')
                     ->select(DB::raw('sum(precioProducto) as suma, month(created_at) as mes'))
                     ->groupBy('mes')
                     ->get();

      return view('dashboard.dashboard',compact('ventasMes'));
    }
}
