<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clientes;
use App\Models\direcciones;
use App\Models\clientes_direcciones;
use Illuminate\Support\Facades\DB;

class altaclientesController extends Controller
{
    public function index()
    {
      // $cliente = new Clientes;
      // $clientes = $cliente->all();
      $clientes = DB::table('clientes')
                  ->join('clientes_direcciones', 'clientes.id', '=', 'clientes_direcciones.idcliente')
                  ->join('direcciones', 'direcciones.id', '=', 'clientes_direcciones.iddireccion')
                  ->select('*')
                  ->get();

      $estados = DB::connection("ciudades")
        ->table("estados")
        ->select("estados.*")
        ->get();
      return view('Clientes.AltaClientes',compact('clientes', 'estados'));
    }

    public function nuevo(Request $request)
    {
      //para pruebas
      //dd($request->RazonSocial);

      $clientenuevo = new Clientes();
      $clientenuevo->nombre = $request->nombre;
      $clientenuevo->razonSocial = $request->RazonSocial;

      $clientenuevo->rfc = $request->Rfc;
      $clientenuevo->email = $request->Correo;
      $clientenuevo->limiteCredito = $request->LimiteDeCredito;
      $clientenuevo->credito = 0;
      $clientenuevo->telefono1 = $request->Telefono1.",".$request->Telefono2.",".$request->Telefono3;

      $clientenuevo->consumoTotal = 0;

      $clientenuevo->save();

      $direcciones = new direcciones();
      $clientes_direcciones = new clientes_direcciones();

      $direcciones->numInterior=$request->numInterior;
      $direcciones->numExterior=$request->numExterior;
      $direcciones->calle=$request->calle;
      $direcciones->entre1=$request->entre1;
      $direcciones->entre2=$request->entre2;
      $direcciones->referencia=$request->referencia;
      $direcciones->colonia=$request->colonia;
      $direcciones->cp=$request->CP;
      $direcciones->ciudad=$request->ciudad;
      $direcciones->estado=$request->estado;
      $direcciones->save();

      $clientes_direcciones->idCliente = $clientenuevo->id;
      $clientes_direcciones->idDireccion = $direcciones->id;
      $clientes_direcciones->save();

      return redirect()->route("AltaClientes");
    }

}
