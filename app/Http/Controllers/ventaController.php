<?php

namespace App\Http\Controllers;

use App\Models\clientes;
use App\Models\Ventas;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\Inventario;
use function PhpParser\filesInDir;
use Yajra\Datatables\Datatables;//Prueba dataTables Ajax

class ventaController extends Controller
{


    public function index()
    {
        $productos =    DB::table('productos')
            ->join("inventarios", "inventarios.idProducto", "=", "productos.id" )
            ->select("productos.*", "inventarios.cantidad")
            ->get();

        $clientes = new clientes();
        $clientes = $clientes->all();
        return view('ventas.venta', compact('productos'),compact("clientes"));

    }

    public function realizarVenta(Request $request){

        $cliente = $request->input('cliente');
        $producto = $request->input('producto');
        $cantidad = $request->input('cantidad');
        $existencia = $request->input('existencias');
        $precioProducto = $request->input('precioProducto');
        $subTotal = $request->input('subTotal');
        $total = $request->input('total');
        $folio = $request->input('folio');
        $idProducto = $request->input('idProdcuto');
        $credito = $request->input('credito');

        $clientes = explode(",", $cliente[0]);
        $productos = explode(",", $producto[0]);
        $cantidades = explode(",", $cantidad[0]);
        $precios = explode(",", $precioProducto[0]);
        $subTotales = explode(",", $subTotal[0]);
        $idProductos = explode(",", $idProducto[0]);
        $existencias = explode(",", $existencia[0]);



            $i = count($productos);


            for ($a=0; $a<$i; $a++ ){

                $ventas = new Ventas();
                $clienteAdd = $clientes[$a];
                $productoAdd = $productos[$a];
                $cantidadAdd = $cantidades[$a];
                $precioAdd = $precios[$a];
                $subTotaleAdd = $subTotales[$a];
                $idProductoAdd = $idProductos[$a];
                $existenciaAdd = $existencias[$a];
                $totalAdd = $total[0];
                $folioAdd = $folio[0];
                $creditoAdd = $credito[0];
                $ventas -> folio = $folioAdd;
                $ventas -> vendedor = $request->input('vendedor');
                $ventas -> cliente= $clienteAdd;
                $ventas -> producto= $productoAdd;
                $ventas ->  cantidad= $cantidadAdd;
                $ventas -> precioProducto = $precioAdd;
                $ventas -> subTotal = $subTotaleAdd;
                $ventas -> total =  $totalAdd;
                $ventas->save();
                $inventario = new Inventario();


                $existenciaActual = intval($existenciaAdd);
                $cantidadRestar =  intval($cantidadAdd);

                $existenciaAdd = $existenciaActual -  $cantidadRestar;

                $inventario::where ("idProducto",$idProductoAdd)->update(["cantidad"=>$existenciaAdd]);


                $credito = new clientes();
                $credito::where ("rfc",$clienteAdd)->update(["credito"=>$creditoAdd]);
            }




        \Session::flash('Guardado','Se guardo correctamente la venta');
        return redirect()->route("venta");

    }



}
