<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Clientes;

class altaclientesController extends Controller
{
    public function index()
    {
      $cliente = new Clientes;
      $clientes = $cliente->all();

      return view('Clientes.AltaClientes',compact('clientes'));
    }

    public function nuevo(Request $request)
    {
      //para pruebas
      //dd($request->RazonSocial);

      $clientenuevo = new Clientes();
      $clientenuevo->nombre = $request->nombre;
      $clientenuevo->razonSocial = $request->RazonSocial;
      $clientenuevo->contacto = $request->Contacto;
      $clientenuevo->rfc = $request->Rfc;
      $clientenuevo->email = $request->Correo;
      $clientenuevo->limiteCredito = $request->LimiteDeCredito;
      $clientenuevo->credito = 0;
      $clientenuevo->telefono1 = $request->Telefono1;
      $clientenuevo->telefono2 = $request->Telefono1;
      $clientenuevo->telefono3 = $request->Telefono1;
      $clientenuevo->consumoTotal = 0;
      $clientenuevo->idDireccion = 1;
      $clientenuevo->save();

      return redirect()->route("AltaClientes");
    }

}
