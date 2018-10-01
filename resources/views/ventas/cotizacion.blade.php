@extends('layouts.layout')

@section('content')
    <style type="text/css">
        body,html{
            height:100%; /*Siempre es necesario cuando trabajamos con alturas*/
        }
        #inferior{
            color: #FFF;
            background: #000;
            position:absolute; /*El div será ubicado con relación a la pantalla*/
            left:0px; /*A la derecha deje un espacio de 0px*/
            right:0px; /*A la izquierda deje un espacio de 0px*/
            bottom:0px; /*Abajo deje un espacio de 0px*/
            height:50px; /*alto del div*/
            z-index:0;
        }
    </style>

    <img src="http://www.linkbyme.com.mx/staticimg/092013/logo-200197189-156-b.jpg">
    <pre>                                                       Fecha :   @foreach($coti as $product){{$product->created_at}}
            @break
        @endforeach
                                           Cotización NO:    @foreach($coti as $product) {{$product->folio}}
            @break
        @endforeach
    </pre>
    <h1 class="page-header">Cotización</h1>
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
    <div id="inferior">
    <pre>                                                              Subtotal:$@foreach($total as $product){{$product->Total}}
            @break
        @endforeach                                                  IVA(16%):$@foreach($total as $product){{$product->Total*.16}}
        @break
        @endforeach                                                      Importe total:$ @foreach($total as $product){{$product->Total + ($product->Total*.16)}}
        @break
        @endforeach    </pre>
    </div>
@endsection