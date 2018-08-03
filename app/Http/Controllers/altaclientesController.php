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
}
