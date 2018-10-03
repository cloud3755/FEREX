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

    public function historialDetalle($idVenta)
    {
        $historial = DB::table("ventas")
        ->join("users", "users.id","=","ventas.idVendedor")
        ->join("clientes", "clientes.id","=", "ventas.idCliente")
        ->join("ventas_detalles", "ventas_detalles.idVenta", "=", "ventas.id")
        ->where("ventas.id", "=", $idVenta)
        
        ->select(
            "ventas.id",
            "ventas.folio",
            "users.name as nombreVendedor",
            "clientes.nombre as nombreCliente",
            "ventas_detalles.Producto",
            "ventas_detalles.cantidad",
            "ventas_detalles.precio",
            "ventas.formaDePago",
            "ventas_detalles.created_at",
            DB::raw("(ventas_detalles.cantidad * ventas_detalles.precio) as totalLinea")
        )
        ->get();
        $vendedor = $historial->pluck('nombreVendedor')->first();
        $cliente = $historial->pluck('nombreCliente')->first();
        $formaDePago = $historial->pluck('formaDePago')->first();
        $folio = $historial->pluck('folio')->first();
       // $total = $historial->pluck('Total')->first();
        return view("ventas.ventaHistorialDetalle",
            compact("historial",
                    "vendedor",
                    "cliente",
                    "formaDePago",
                    "folio"
                    ));

    }

    public function historial(){

     $historial = DB::table("ventas")
    ->join("clientes", "clientes.id","=", "ventas.idCliente")
    ->join("users", "users.id","=","ventas.idVendedor")
    ->join("ventas_detalles", "ventas_detalles.idVenta", "=", "ventas.id")
    ->groupBy('ventas.id')
    ->where("ventas.cotizacion",0)
    ->select(
        "ventas.id",
        "ventas.folio",
        "users.name",
        "clientes.nombre",
        "ventas.formaDePago", 
        "ventas.created_at",
        DB::raw("SUM(ventas_detalles.cantidad * ventas_detalles.precio) as Total"))->get();







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
        $ventas -> formaDePago = "cotizacion";
        $ventas -> cotizacion = 1;
        $ventas -> idVendedor = Auth::user()->id;
        $ventas -> idCliente= $clienteAdd;
        $ventas->save();

        $ventaId= $ventas->id;
        echo $ventaId;
        for ($a=0; $a<$i; $a++ ) {

            $productoAdd = $productos[$a];
            $cantidadAdd = $cantidades[$a];
            $precioAdd = $precios[$a];
            $idProductoAdd = $idProductos[$a];
            $existenciaAdd = $existencias[$a];

            $creditoAdd = $credito[0];
            $saldoAdd = $saldo[0];
            $ventasDetalle = new ventasDetalle();
            $ventasDetalle->Producto = $productoAdd;
            $ventasDetalle->cantidad = $cantidadAdd;
            $ventasDetalle->precio = $precioAdd;
            $ventasDetalle->idVenta = $ventaId;
            $ventasDetalle->idProducto = $idProductoAdd;
            $ventasDetalle->save();


        }

$id = $ventas ->id;

        $total =    DB::table('ventas_detalles')
            ->join("ventas", "ventas.id", "=", "ventas_detalles.idVenta" )
            ->join("clientes","clientes.id","=","ventas.idCliente")

            ->where("ventas.id",$id)
            ->select(DB::raw("SUM(ventas_detalles.cantidad * ventas_detalles.precio) as Total"))->get();







        $coti =    DB::table('ventas_detalles')
            ->join("ventas", "ventas.id", "=", "ventas_detalles.idVenta" )
            ->join("clientes","clientes.id","=","ventas.idCliente")
            ->join("users","users.id","=","ventas.idVendedor")
            ->where("ventas.id",$id)
            ->select("ventas.folio", "users.idSucursal","ventas.created_at",
                "clientes.nombre",
                "ventas_detalles.cantidad","ventas_detalles.Producto",
                "ventas_detalles.precio")->get();





       $top = TOPDF::loadView('ventas.cotizacion', compact("coti","total"));

        return $top->stream();


    }


    public function cotizacionHistorial(){

        $historial = DB::table("ventas")
            ->join("clientes", "clientes.id","=", "ventas.idCliente")
            ->join("users", "users.id","=","ventas.idVendedor")
            ->join("ventas_detalles", "ventas_detalles.idVenta", "=", "ventas.id")
            ->groupBy('ventas.id')
            ->where("ventas.cotizacion",1)
            ->select(
                "ventas.id",
                "ventas.folio",
                "users.name",
                "clientes.nombre",
                "ventas.formaDePago",
                "ventas.created_at",
                DB::raw("SUM(ventas_detalles.cantidad * ventas_detalles.precio) as Total"))->get();







//SELECT ventas.id,users.name,clientes.nombre,ventas_detalles.Producto,ventas_detalles.cantidad,ventas_detalles.precio,ventas.formaDePago, ventas_detalles.created_at FROM `ventas`
// INNER JOIN ventas_detalles ON ventas.id = ventas_detalles.idVenta
        //       INNER JOIN clientes ON ventas.idCliente = clientes.id
//INNER JOIN users ON ventas.idVendedor = users.id

        return view("ventas.cotizacionHistorial",compact("historial"));
    }

    public function cotizacionHistorialDetalle($id){


        $total =    DB::table('ventas_detalles')
            ->join("ventas", "ventas.id", "=", "ventas_detalles.idVenta" )
            ->join("clientes","clientes.id","=","ventas.idCliente")

            ->where("ventas.id",$id)
            ->select(DB::raw("SUM(ventas_detalles.cantidad * ventas_detalles.precio) as Total"))->get();







        $coti =    DB::table('ventas_detalles')
            ->join("ventas", "ventas.id", "=", "ventas_detalles.idVenta" )
            ->join("clientes","clientes.id","=","ventas.idCliente")
            ->join("users","users.id","=","ventas.idVendedor")
            ->where("ventas.id",$id)
            ->select("ventas.folio","users.idSucursal", "ventas.created_at",
                "clientes.nombre",
                "ventas_detalles.cantidad","ventas_detalles.Producto",
                "ventas_detalles.precio")->get();

        $top = TOPDF::loadView('ventas.cotizacion', compact("coti","total"));

        return $top->stream();

    }

    public function venderCotizacion(Request $request){

        $folio = $request->input('folio');
        $total = $request->input('total');
        $formaPago = $request->input('formaPago');
        $ventas = new Ventas();
        $ventas::where ("folio",$folio)->update(["formaDePago"=>$formaPago,"cotizacion"=>0]);



        $producto =    DB::table('ventas')
            ->join("ventas_detalles", "ventas.id", "=", "ventas_detalles.idVenta" )
            ->join("inventarios", "ventas_detalles.idProducto", "=", "inventarios.idProducto" )
            ->select("ventas_detalles.idProducto", "ventas_detalles.cantidad AS cantidadVendida","inventarios.cantidad AS cantidadInventario")
            ->where("folio",$folio)
            ->get();



        $inventario = new Inventario();
        $existenciaActual = intval($producto[0]->cantidadInventario);
        $cantidadRestar =  intval($producto[0]->cantidadVendida);
        $idProductoAdd = $producto[0]->idProducto;
        $existenciaAdd = $existenciaActual -  $cantidadRestar;
        $inventario::where("idProducto",$idProductoAdd)->where("idSucursal",Auth::user()->idSucursal)-> update(["cantidad"=>$existenciaAdd]);


        $status = new caja();
        $status = $status->all();
if ($formaPago == "efectivo") {
    $saldoAdd = $total + $status[0]->saldo;
    $saldo = new caja();
    $saldo::where("id", Auth::user()->idSucursal)->update(["saldo" => $saldoAdd]);


}
        \Session::flash('Guardado','Se guardo correctamente la venta');
        return redirect()->route("cotizacionHistorial");
    }

    public function realizarVenta(Request $request)
    {

        $tipoImpresion = $request->tipoImpresion;
        //dd($request);
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
        $ventas -> cotizacion = 0;
        $ventas -> idVendedor = Auth::user()->id;
        $ventas -> idCliente= $clienteAdd;
        $ventas->save();

        $ventaId= $ventas->id;
        
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

        
        \Session::flash('Guardado','Se guardo correctamente la venta');
        \Session::flash('idVenta',$ventaId);
        \Session::flash('tipoImpresion',$tipoImpresion);
        
        return redirect()->route("venta");
    }

    public function printVenta($idVenta, $tipoImpresion)
    {
        $view = 'partials.Print.VentaPdf2';
        $datosVenta = $this->returnDataVentaPrint($idVenta);
       // $fechaImpresion = date('d/m/a', time());
        
        $fechaImpresion = date('d/m/y', time());
        $folio=  $datosVenta->pluck('folio')->first();
        $nombreCliente=  $datosVenta->pluck('nombreCliente')->first();
        $nombreVendedor=  $datosVenta->pluck('nombreVendedor')->first();
        $numExterior=  $datosVenta->pluck('numExterior')->first();
        $calle=  $datosVenta->pluck('calle')->first();
        $colonia=  $datosVenta->pluck('colonia')->first();
        $cp=  $datosVenta->pluck('cp')->first();
        $ciudad=  $datosVenta->pluck('ciudad')->first();
        $estado=  $datosVenta->pluck('estado')->first();
        $numExteriorCliente=  $datosVenta->pluck('numExteriorCliente')->first();
        $calleCliente=  $datosVenta->pluck('calleCliente')->first();
        $coloniaCliente=  $datosVenta->pluck('coloniaCliente')->first();
        $cpCliente=  $datosVenta->pluck('cpCliente')->first();
        $ciudadCliente=  $datosVenta->pluck('ciudadCliente')->first();
        $estadoCliente=  $datosVenta->pluck('estadoCliente')->first();
        $title = "Venta";
        $fechaVenta=  \Carbon\Carbon::parse($datosVenta->pluck('created_at')->first())->format('d/m/y');
        //$fechaVenta=  date('d/m/a', strtotime($datosVenta->pluck('created_at')->first()));
        $total=  $datosVenta->sum('totalLinea');
        switch($tipoImpresion)
        {
            case 'pdf':
            $view = 'partials.Print.VentaPdf2';
            $top = TOPDF::loadView( $view, 
            compact(    
                "calleCliente",
                "coloniaCliente",
                "cpCliente",
                "ciudadCliente",
                "estadoCliente",
                "numExteriorCliente",
                "title",        
                "datosVenta" ,
                "fechaImpresion" ,
                "folio",
                "nombreCliente",
                "nombreVendedor",
                "numExterior",
                "calle",
                "colonia",
                "cp",
                "ciudad",
                "estado",
                "fechaVenta",
                "total"
            ));
        

        
        return $top->stream();
            break;
            case 'ticket':
            $view = 'partials.Print.VentaTicket';
            break;
        }
        

        
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
        ->leftjoin("clientes_direcciones", "clientes.id", "=", "clientes_direcciones.idCliente")
        ->leftjoin("direcciones as dirCliente", "dirCliente.id", "=", "clientes_direcciones.idDireccion")
        ->whereRaw("ventas.id = ".$idVenta)
        ->select(
            "clientes.nombre as nombreCliente",
            "ventas.formaDePago as formaDePago",
            "ventas.folio",
            "ventas.created_at",
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
            "dirCliente.numExterior as numExteriorCliente",
            "dirCliente.calle as calleCliente",
            "dirCliente.colonia as coloniaCliente",
            "dirCliente.cp as cpCliente",
            "dirCliente.ciudad as ciudadCliente",
            "dirCliente.estado as estadoCliente",
            DB::raw("(ventas_detalles.cantidad * ventas_detalles.precio) as totalLinea")
            )
        ->get();
        
        
    }

}
