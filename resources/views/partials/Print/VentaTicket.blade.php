@php
    $venta = $datosVenta;
    $folio = $venta->pluck('folio')->first();
    $nombreCliente = $venta->pluck('nombreCliente')->first();
    $total=0;
@endphp
<div id="print">
    <section class="sheet">
        <div>********************************</div>
        <div>********************************</div>
        <div>FEREX</div>
        <div>PRODUCTO**PREC&iexcl;O**CANT*****TOTAL</div>
        @foreach($venta as $datosVenta)
        <div>
            {!!substr($datosVenta->nombreProducto, 0 , 10 )!!}
            {!!substr($datosVenta->nombreProducto, 0 , 10 )!!}

        </div>
                <td></td>
                <td>{{$datosVenta->cantidad}}</td>
                <td>{{$datosVenta->precio}}</td>
                <td>{{$datosVenta->totalLinea}}</td>
            </tr>@php $total+= $datosVenta->totalLinea@endphp
        @endforeach
        <div>********************************</div>
    </section>
</div>


<script>
    var contents = document.getElementById("print").innerHTML;
    var frame1 = document.createElement('iframe');
    frame1.name = "frame1";

    document.body.appendChild(frame1);
    var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
    frameDoc.document.open();
    frameDoc.document.write(
    '    <html lang="en"> '+
    '    <head>'+
    '    <meta charset="utf-8">'+
    '   <title>receipt</title>'+
    '    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/3.0.3/normalize.css">'+
    '    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/paper-css/0.3.0/paper.css">'+
    '    <style>'+
        '@page '+ 
    '{'+
    '    size:  80mm;   /* auto is the initial value */'+
    '    margin: 0mm;  /* this affects the margin in the printer settings */'+
    '}'+
    'html'+
    '{'+
    '    background-color: #FFFFFF; '+
    '    margin: 0px;  /* this affects the margin on the html before sending to printer */'+
    '}'+
    '        body.receipt .sheet { width: 100mm;  } /* sheet size */'+
    '        @media print { body.receipt { width: 100mm } } /* fix for Chrome */'+
    '    </style>'+
    '    </head>'+
    '    <body class="receipt">')
frameDoc.document.write()
frameDoc.document.write('</body></html>');

    frameDoc.document.close();
    setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        document.body.removeChild(frame1);
    }, 500);

<script>