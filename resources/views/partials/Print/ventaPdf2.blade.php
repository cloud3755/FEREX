@extends('layouts.layout')

@section('content')

@php
    $venta = $datosVenta;
    $folio = $venta->pluck('folio')->first();
    $nombreCliente = $venta->pluck('nombreCliente')->first();
    $nombreVendedor = $venta->pluck('nombreVendedor')->first();
    $numExterior = $venta->pluck('numExterior')->first();
    $calle = $venta->pluck('calle')->first();
    $colonia = $venta->pluck('colonia')->first();
    $cp = $venta->pluck('cp')->first();
    $ciudad = $venta->pluck('ciudad')->first();
    $estado = $venta->pluck('estado')->first();
    $total=0;
    date_default_timezone_set('America/Mexico_City');
    $date = date('DD/MM/AAAA h:i:s a', time());
@endphp

    <img src="http://www.linkbyme.com.mx/staticimg/092013/logo-200197189-156-b.jpg">
    <pre>                                                       Fecha :   {{$date}}
 
                                           Folio:           {{$folio}}

    </pre>
    <h1 class="page-header">Venta</h1>
    Facturar a:
    {{$nombreCliente}}
    {{$numExterior}} {{$calle}} {{$colonia}}    
    {{$cp}} {{$ciudad}} {{$estado}}

    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>PRODUCTO</th>
            <th>CANTIDAD</th>
            <th>PRECIO</th>
            <th>TOTAL</th>
        </tr>
        </thead>
        <tbody>
        @foreach($venta as $datosVenta)
            <tr>
                <td>{{ $datosVenta->nombreProducto}}</td>
                <td>{{intval($datosVenta->cantidad* 1e2) / 1e2}}</td>
                <td>{{intval($datosVenta->precio* 1e2) / 1e2}}</td>
                <td>{{intval($datosVenta->totalLinea * 1e2) / 1e2}}</td>
                @php $total+= $datosVenta->totalLinea @endphp
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td>Total: </td>
                <td>{{$total}}</td>
            </tr>
        </tfoot>
    </table>
    <hr>
    <pre>                                                               </pre>
    <p>

    </p>
@endsection
