<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <title>Print Test</title>

</head>
<body>
  <div id="print">
    <div>FEREX</div>
    <span>Producto</span><span>Cantidad</span><span>precio</span>    
   </div>
  <div><button onclick="print4();">Imprimir</button></div>
</body>
</html>

<script>
    function print4()
    {
          var mywindow = window.open('', 'PRINT', 'height=400,width=600');
    var string ="";
    for(var i = 33; i<126; i++)
        string +=String.fromCharCode(i);
    replace = string;
    var  replace= replace.replace(/\I/gi, '¡');
    console.log(replace);
    replace = replace.replace(/\./gi, '⋅');
    replace = replace.replace(/\./gi, '⋅');
    replace = replace.replace(/\,/gi, '⋅');
    replace = replace.replace(/\//gi, '>');
    replace = replace.replace(/\\/gi, '>');
    //replace = replace.replace(/\f/i, 'F');
    replace = replace.split('f').join('F');
    replace = replace.replace(/\j/gi, 'J');
    replace = replace.replace(/\l/gi, 'L');
    replace = replace.replace(/\t/g, 'T');
    replace = replace.replace(/\f/gi, '>');
    
    replace = replace.replace(/\:/gi, '=');
    replace = replace.split(' ').join('*');

    string = replace;
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
    mywindow.document.write(string)
    mywindow.document.write('</body></html>');
    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/
//mywindow.open();
    mywindow.print();
    mywindow.close();
    }
    function PrintDiv3() {
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
    '    <body class="receipt">'+
    '    <section class="sheet">'+
    '    <div>********************************</div>'+
    '    <div>********************************</div>'+
    '    <div>FEREX</div>'+
    '    <div>PRODUCTO&#32;PREC&iexcl;O**CANT*****TOTAL</div>'+
    '    <div>PRUEBA****10&sdot;00****1*******10</div>'+
    '    <div>********************************</div>'+
    '    </section>'+
    '    </body>'+
    '    </html>');

    frameDoc.document.close();
    setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        document.body.removeChild(frame1);
    }, 500);
    return false;
}

        function PrintDiv2() {
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
    '    <title>receipt</title>'+

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
    '    </head>'+
    '    <body>'+
    'ProductoCantidadValorTotal'+
    '    </body>'+
    '    </html>');

    frameDoc.document.close();
    setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        document.body.removeChild(frame1);
    }, 500);
    return false;
}
    function PrintDiv() {
    var contents = document.getElementById("print").innerHTML;
    var frame1 = document.createElement('iframe');
    frame1.name = "frame1";
    frame1.style.position = "absolute";
    frame1.style.top = "-1000000px";
    document.body.appendChild(frame1);
    var frameDoc = frame1.contentWindow ? frame1.contentWindow : frame1.contentDocument.document ? frame1.contentDocument.document : frame1.contentDocument;
    frameDoc.document.open();
    frameDoc.document.write('<html><head><title>DIV Contents</title>'+
    '<style type="text/css" media="print">'+
    '@page '+ 
    '{'+
    '    size:  58mm;   /* auto is the initial value */'+
    '    margin: 0mm;  /* this affects the margin in the printer settings */'+
    '}'+
    'html'+
    '{'+
    '    background-color: #FFFFFF; '+
    '    margin: 0px;  /* this affects the margin on the html before sending to printer */'+
    '}'+
    'body'+
    '{'+
    '    border: solid 1px blue ;'+
    '    margin: 10mm 15mm 10mm 15mm; /* margin you want for the content */'+
    '    font-size: 8px;'+
    '}'+
  
    '</style>');
    frameDoc.document.write('</head><body>');
    frameDoc.document.write(contents);
    frameDoc.document.write('</body></html>');
    frameDoc.document.close();
    setTimeout(function () {
        window.frames["frame1"].focus();
        window.frames["frame1"].print();
        document.body.removeChild(frame1);
    }, 500);
    return false;
}
</script>


