<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ciudadesController extends Controller
{
    public function estados()
    {
        $estados = DB::connection("ciudades")
        ->table("estados")
        ->select("estados.*")
        ->get();
        return $estados;

    }

    public function municipiosEstado($idEstado)
    {
        $municipiosEstados = 
        DB::connection("ciudades")
        ->table("municipios")
        ->select("municipios.*")
        ->where("municipios.idEstado", "=", $idEstado)
        ->get();
        return $municipiosEstados;
    }
}
