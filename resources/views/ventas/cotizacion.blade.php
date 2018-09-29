@extends('layouts.layout')

@section('content')

    <img src="http://www.linkbyme.com.mx/staticimg/092013/logo-200197189-156-b.jpg">
    <pre>                                                       Fecha :   @foreach($coti as $product){{$product->created_at}}
            @break
        @endforeach
                                           Cotizacion NO:    @foreach($coti as $product) {{$product->folio}}
            @break
        @endforeach
    </pre>
    <h1 class="page-header">Cotazacion</h1>
    Facturar a:

    @foreach($coti as $product)

    {{$product->nombre}}
    @break
    @endforeach

    <table class="table table-hover table-striped">
        <thead>
        <tr>
            <th>CANTIDAD</th>
            <th>PRODUCTO</th>
            <th>PRECIO</th>
            <th>TOTAL</th>


        </tr>
        </thead>
        <tbody>
        @foreach($coti as $product)
            <tr>
                <td>{{ $product->cantidad}}</td>
                <td>{{ $product->Producto}}</td>
                <td>{{ $product->precio}}</td>
                <td>{{ $product->precio*$product->cantidad}}</td>

            </tr>
        @endforeach
        </tbody>
    </table>
    <hr>
    <pre>                                                              Subtotal:$@foreach($coti as $product){{$product->Total}}
            @break
        @endforeach                                                  IVA(16%):$@foreach($coti as $product){{$product->Total*.16}}
        @break
        @endforeach                                                      Importe total:$ @foreach($coti as $product){{$product->Total + ($product->Total*.16)}}
        @break
        @endforeach    </pre>
    <p>

    </p>
@endsection