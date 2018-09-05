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
        $historialCaja = DB::table("corte_cajas");
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
