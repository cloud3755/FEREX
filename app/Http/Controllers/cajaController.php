<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\caja;
use App\Models\corteCaja;


class cajaController extends Controller
{
    
    
    public function index()
    {
        $estadosCaja = array(
            "A" => "Arqueo",
            "AB" => "Abierta",
            "NI" => "No iniciada"
        );
        $cajas  =  
        DB::table('cajas')
        ->join('sucursales', 'sucursales.id', '=', 'cajas.idSucursal')
        ->select("cajas.id", "cajas.saldo", "cajas.nombre", 'estado', 'sucursales.nombre as sucursal', 
        DB::raw("case when estado = 'A' THEN 'ARQUEO' 
        WHEN estado = 'AB' THEN 'abierta' 
        WHEN estado = 'NI' THEN 'No iniciada' END as estadoNombre ")
        )
        ->get();
        
       // dd($cajas);
        return view('caja.inicioCaja', compact('cajas'));
    }

    function historial()
    {
        $historialCaja = DB::table("corte_cajas")
        ->join("users" , "users.id", "=", "corte_cajas.idUsuario")
        ->join("cajas", "cajas.id", "=", "corte_cajas.idCaja")
        ->join("sucursales", "cajas.idSucursal","=", "sucursales.id")
        ->select("users.name as nombreUsuario",
        "sucursales.nombre as nombreSucursal",
        "cajas.nombre as nombreCaja",
        DB::raw("case when tipo = 'A' THEN 'ARQUEO' 
        WHEN tipo = 'C' THEN 'Corte' 
        WHEN tipo = 'I' THEN 'Inicio' END as tipoNombre"),
        "corte_cajas.saldoSistema", "corte_cajas.saldoCapturado",
        "corte_cajas.fechaHora",
        DB::raw("(corte_cajas.saldoCapturado  - corte_cajas.saldoSistema) as diferencia"))
        ->orderBy('fechaHora', 'desc')
        ->get();

        return view("caja.HistorialCaja", compact("historialCaja"));
        //dd($historialCaja);
    }
    function cambioEstadoCaja(Request $request)
    {
        $datosCaja = json_decode($request->datosCaja);
        //dd($datosCaja);
        switch($datosCaja->operacion)
        {
            case "I":
                $caja = caja::find($datosCaja->idCaja);
                $caja->saldo = $datosCaja->saldo;
                $caja->estado = $datosCaja->operacion;
                $caja->save();
                $corte = new corteCaja();
                $corte->setByRequest($datosCaja);
               
                $corte->save();
            break;

            case "A":
                $corte = new corteCaja();
                $corte->setByRequest($datosCaja);
                
                $corte->save();
            break;

            case "C" : 
                $caja = caja::find($datosCaja->idCaja);
                $caja->saldo = 0;
                $caja->estado = "NI";
                $caja->save();
                $corte = new corteCaja();
                $corte->setByRequest($datosCaja);
                
                $corte->save();
            break;
            
        }
        \Session::flash('Guardado','Se hizo la operacion correctamente');
            return redirect()->route("cajas"); 
    }
}
