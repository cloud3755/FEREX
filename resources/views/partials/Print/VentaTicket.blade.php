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
    function fillString($str,$maxLen, $padType)
    {
        return (strlen($str) < $maxLen) ? 
            str_pad($str, $maxLen, "_",$padType) :
            substr($str, 0, $maxLen);
    }
@endphp
<div id="print">
    <section id="sheet">
        <div>********************************</div>
        <div>{{fillString("FEREX", 32, STR_PAD_BOTH)}}</div>
        <div>{{fillString($calle, 32, STR_PAD_BOTH)}}</div>
        <div>{{fillString($numExterior, 32, STR_PAD_BOTH)}}</div>
        <div>{{fillString($colonia, 32, STR_PAD_BOTH)}}</div>
        <div>{{fillString($cp, 32, STR_PAD_BOTH)}}</div>
        <div>{{fillString($ciudad."*".$estado, 32, STR_PAD_BOTH)}}</div>
        <div>FOLIO:{{fillString($folio, 26, STR_PAD_RIGHT)}}</div>
        <div>Cliente:{{fillString($nombreCliente, 24, STR_PAD_RIGHT)}}</div>
        <div>Vendedor:{{fillString($nombreVendedor, 23, STR_PAD_RIGHT)}}</div>
        <div>PRODUCTO_____PRECIO__CANT____TOT</div>
        @foreach($venta as $datosVenta)
        <div>{{fillString(trim($datosVenta->nombreProducto), 12, STR_PAD_RIGHT)}}{{fillString(trim(intval($datosVenta->precio* 1e2) / 1e2), 7, STR_PAD_LEFT)}}{{fillString(trim(intval($datosVenta->cantidad* 1e2) / 1e2), 6, STR_PAD_LEFT)}}{{fillString(trim(intval($datosVenta->totalLinea * 1e2) / 1e2), 7, STR_PAD_LEFT)}}</div>
            @php $total+= $datosVenta->totalLinea @endphp
        
        @endforeach
        <div>{{fillString("TOTAL:*".intval($total * 1e2) / 1e2, 32,STR_PAD_LEFT)}}</div>
        <div>********************************</div>
        
    </section>
</div>


<script>
String.prototype.replaceAt=function(index, replacement) {
    return this.substr(0, index) + replacement+ this.substr(index + replacement.length);
}
$('#sheet')
  .contents() // get all child nodes
  .each(function() { // iterate over them
   
    var  replace= $(this).text().replace(/\I/gi, '¡');
    console.log(replace);
    replace = replace.replace(/\./gi, '⋅');
    replace = replace.replace(/\./gi, '⋅');
    replace = replace.replace(/\,/gi, '⋅');
    replace = replace.replace(/\//gi, '>');
    replace = replace.replace(/\\/gi, '>');
    //replace = replace.replace(/\f/i, 'F');
    replace = replace.split('f').join('F');
    replace = replace.split('t').join('T');
    replace = replace.replace(/\j/gi, 'J');
    replace = replace.replace(/\l/gi, 'L');
    //replace = replace.replace(/\t/gi, 'T');
    replace = replace.replace(/\:/gi, '=');
    replace = replace.split(' ').join('_');

    $(this).text(replace); // update text content if it's text node
  });
//$("#print < div").text().replace(/\i/g, '&iexcl;');
  var mywindow = window.open('', 'PRINT', 'height=400,width=600');
$data = $('#sheet').html();
    mywindow.document.write(
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
    mywindow.document.write($data)
    mywindow.document.write('</body></html>');
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/
//mywindow.open();
    mywindow.print();
    mywindow.close();


</script>