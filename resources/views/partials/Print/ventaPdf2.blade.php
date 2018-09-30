@extends('layouts.layout')

@section('content')

    
   <!-- <img src="http://www.linkbyme.com.mx/staticimg/092013/logo-200197189-156-b.jpg">-->
    <h1 class="page-header">Venta</h1>
    <pre>
FEREX<br>
{{$numExterior}} {{$calle}} {{$colonia}}<br>    
{{$cp}} {{$ciudad}} {{$estado}}<br>
    </pre>
    <pre>
<b>Fecha de impresi&oacute;n:</b>  {{$fechaImpresion}}<br>
<b>Fecha de venta:</b>      {{$fechaVenta}}<br>
<b>Folio:</b>               {{$folio}}<br>
<b>Cliente:</b>
{{$nombreCliente}}<br>
{{$numExteriorCliente}} {{$calleCliente}} {{$coloniaCliente}}<br>    
{{$cpCliente}} {{$ciudadCliente}} {{$estadoCliente}}<br>
    </pre>
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
        @foreach($datosVenta as $venta)
            <tr>
                <td>{{ $venta->nombreProducto}}</td>
                <td>{{intval($venta->cantidad* 1e2) / 1e2}}</td>
                <td>{{intval($venta->precio* 1e2) / 1e2}}</td>
                <td>{{intval($venta->totalLinea * 1e2) / 1e2}}</td>
               
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
