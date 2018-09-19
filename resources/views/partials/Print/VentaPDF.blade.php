@php
    $venta = $datosVenta;
    $folio = $venta->pluck('folio')->first();
    $nombreCliente = $venta->pluck('nombreCliente')->first();
    $total=0;
@endphp


    <div id="Venta" hidden>
        <H3>FEREX</H3>
    <p>Dirección: Av Mariano Otero 5099, La Calma, 45070 Zapopan, Jal.</p>
    <p>Teléfono: 01 33 3070 1462</p> 
    <p>FOLIO: {{$folio}} Cliente : {{$nombreCliente}}</p>
    <br>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Subtotal</th>
            </tr>
        </thead>
        <tbody>
            @foreach($venta as $datosVenta)
            <tr>
                <td>{{$datosVenta->nombreProducto}}</td>
                <td>{{$datosVenta->cantidad}}</td>
                <td>{{$datosVenta->precio}}</td>
                <td>{{$datosVenta->totalLinea}}</td>
            </tr>@php $total+= $datosVenta->totalLinea@endphp
            @endforeach
        </tbody>
        <tfoot>
            <tr>
                <td></td>
                <td></td>
                <td>TOTAL</td>
                <td>{{$total}}</td>
            </tr>
        </tfoot>
    </table>
    </div>

<script>
    var mywindow = window.open('', 'PRINT', 'height=400,width=600');
    var datos = document.getElementById("Venta").innerHTML
   
    mywindow.document.write('<html><head><title>CheckList</title>'+
    '<style type="text/css" media="print">'+
    '@page '+ 
    '{'+
    '    size:  58mm;   /* auto is the initial value */'+
    '    margin: 1mm;  /* this affects the margin in the printer settings */'+
    '}'+
    'html'+
    '{'+
    '    background-color: #FFFFFF; '+
    '    margin: 0px;  /* this affects the margin on the html before sending to printer */'+
    '}'+
    '</style>'+
    '</head>');
    mywindow.document.write(datos);
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/
//mywindow.open();
    mywindow.print();
    mywindow.close();


</script>