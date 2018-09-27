<?php

namespace App\Http\Controllers;
use Barryvdh\DomPDF\Facade as TOPDF;

use App\Models\clientes;
use App\Models\Ventas;
use App\Models\caja;
use App\Models\ventasDetalle;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Models\Producto;
use App\Models\generar_pdf;
use Auth;
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

        $status = new caja();
        $status = $status->all();
        return view('ventas.venta', compact('productos'),compact("clientes","status","vendedor"));

    }

    public function historial(){

$historial = DB::table("ventas")
    ->join("ventas_detalles", "ventas_detalles.idVenta", "=", "ventas.id")
    ->join("clientes", "clientes.id","=", "ventas.idCliente")
    ->join("users", "users.id","=","ventas.idVendedor")
    ->select("ventas.id","users.name","clientes.nombre","ventas_detalles.Producto","ventas_detalles.cantidad","ventas_detalles.precio","ventas.formaDePago","ventas_detalles.created_at")->get();







//SELECT ventas.id,users.name,clientes.nombre,ventas_detalles.Producto,ventas_detalles.cantidad,ventas_detalles.precio,ventas.formaDePago, ventas_detalles.created_at FROM `ventas`
// INNER JOIN ventas_detalles ON ventas.id = ventas_detalles.idVenta
 //       INNER JOIN clientes ON ventas.idCliente = clientes.id
//INNER JOIN users ON ventas.idVendedor = users.id

return view("ventas.ventaHistorial",compact("historial"));
    }


    public function generarCotizacion(Request $request){




        $cliente = $request->input('cliente');
        $producto = $request->input('producto');
        $cantidad = $request->input('cantidad');
        $precioProducto = $request->input('precioProducto');
        $folio = $request->input('folio');
        $idProducto = $request->input('idProdcuto');
        $subTotal = $request->input('subTotal');
        $total = $request->input('total');
        $clientes = explode(",", $cliente[0]);
        $productos = explode(",", $producto[0]);
        $cantidades = explode(",", $cantidad[0]);
        $precios = explode(",", $precioProducto[0]);
        $idProductos = explode(",", $idProducto[0]);
        $subTotal = explode(",", $subTotal[0]);
        $total = explode(",", $total[0]);





        $clienteAdd = $clientes[0];
        $folioAdd = $folio[0];
        $i = count($productos);




        for ($a=0; $a<$i; $a++ ){
            $productoAdd = $productos[$a];
            $cantidadAdd = $cantidades[$a];
            $precioAdd = $precios[$a];
            $subTotalAdd = $subTotal[$a];
            $totalAdd = $total[0];

            $pdf = new generar_pdf();
            $pdf -> folio = $folioAdd;
            $pdf -> cliente= $clienteAdd;
            $pdf -> descripcion= $productoAdd;
            $pdf -> cantidad= $cantidadAdd;
            $pdf -> precio = $precioAdd;
            $pdf -> subTotal = $subTotalAdd;
            $pdf -> total = $totalAdd;
            $pdf -> precio = $precioAdd;


            $pdf ->save();

        }




        $coti =    DB::table('generar_pdfs')
            ->select("generar_pdfs.*")
            ->where("folio",$folioAdd)
            ->get();












        $top = TOPDF::loadView('ventas.cotizacion', compact("coti"));

        return $top->stream();


    }

    public function realizarVenta(Request $request)
    {



        $cliente = $request->input('cliente');
        $producto = $request->input('producto');
        $cantidad = $request->input('cantidad');
        $existencia = $request->input('existencias');
        $precioProducto = $request->input('precioProducto');
        $folio = $request->input('folio');
        $idProducto = $request->input('idProdcuto');
        $credito = $request->input('credito');
        $saldo = $request->input('saldo');
        $formaPago = $request->input('formaPago');
        $clientes = explode(",", $cliente[0]);
        $productos = explode(",", $producto[0]);
        $cantidades = explode(",", $cantidad[0]);
        $precios = explode(",", $precioProducto[0]);
        $idProductos = explode(",", $idProducto[0]);
        $existencias = explode(",", $existencia[0]);

       

        $folioAdd = $folio[0];
        $formaPagoAdd = $formaPago[0];
        $clienteAdd = $clientes[0];
            $i = count($productos);

        $ventas = new Ventas();
        $ventas -> folio = $folioAdd;
        $ventas -> formaDePago = $formaPagoAdd;
        $ventas -> idVendedor = Auth::user()->id;
        $ventas -> idCliente= $clienteAdd;
        $ventas->save();

        $ventaId= $ventas->id;
        echo $ventaId;
            for ($a=0; $a<$i; $a++ ){

                $productoAdd = $productos[$a];
                $cantidadAdd = $cantidades[$a];
                $precioAdd = $precios[$a];
                $idProductoAdd = $idProductos[$a];
                $existenciaAdd = $existencias[$a];

                $creditoAdd = $credito[0];
                $saldoAdd = $saldo[0];
                $ventasDetalle = new ventasDetalle();
                $ventasDetalle -> Producto= $productoAdd;
                $ventasDetalle -> cantidad= $cantidadAdd;
                $ventasDetalle -> precio = $precioAdd;
                $ventasDetalle->idVenta= $ventaId;
                $ventasDetalle -> idProducto = $idProductoAdd;
                $ventasDetalle ->save();
                $inventario = new Inventario();
                $existenciaActual = intval($existenciaAdd);
                $cantidadRestar =  intval($cantidadAdd);
                $existenciaAdd = $existenciaActual -  $cantidadRestar;
                $inventario::where("idProducto",$idProductoAdd)->where("idSucursal",Auth::user()->idSucursal)-> update(["cantidad"=>$existenciaAdd]);
            }


        $credito = new clientes();
        $credito::where ("id",$clienteAdd)->update(["credito"=>$creditoAdd]);
        $saldo = new caja();
        $saldo::where("id",Auth::user()->idSucursal)->update(["saldo"=>$saldoAdd]);

        $datosVenta = $this->returnDataVentaPrint($ventaId);
        \Session::flash('Guardado','Se guardo correctamente la venta');
        \Session::flash('datosVenta',$datosVenta);
       
        return redirect()->route("venta");
    }

    public function returnDataVentaPrint($idVenta)
    {
        return DB::table('ventas')
        ->join("ventas_detalles", "ventas.id", "=", "ventas_detalles.idVenta")
        ->join("users", "users.id", "=", "ventas.idVendedor")
        ->join("sucursales", "sucursales.id", "=", "users.idSucursal")
        ->join("sucursales_direcciones", "sucursales_direcciones.idSucursal", "=", "sucursales.id")
        ->join("direcciones", "direcciones.id", "=", "sucursales_direcciones.idDireccion")
        ->leftjoin("clientes", "ventas.idCliente", "=", "clientes.id")
        ->whereRaw("ventas.id = ".$idVenta)
        ->select(
            "clientes.nombre as nombreCliente",
            "ventas.formaDePago as formaDePago",
            "ventas.folio",
            "ventas_detalles.Producto as nombreProducto",
            "ventas_detalles.cantidad",
            "ventas_detalles.precio",
            "users.name as nombreVendedor",
            "direcciones.numExterior",
            "direcciones.calle",
            "direcciones.colonia",
            "direcciones.cp",
            "direcciones.ciudad",
            "direcciones.estado",
            DB::raw("(ventas_detalles.cantidad * ventas_detalles.precio) as totalLinea")
            )
        ->get();
    }

}
