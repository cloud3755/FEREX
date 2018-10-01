
$(function(){
thedataTables("dataTable", '/productos/get',
[
    
    {data: 'Acciones', name: 'Acciones', orderable: false, searchable: false},
    {data: 'nombre', name: 'nombre'},
    {data: 'descripcion', name: 'descripcion'},
    {data: 'claveProdServ', name: 'claveProdServ'},
    {data: 'precioA', name: 'precioA'},
    {data: 'precioB', name: 'precioB'},
    {data: 'precioC', name: 'precioC'},
    {data: 'codigoBarras', name: 'codigoBarras'},
    {data: 'Existencias', name: 'Existencias'}
    

]
);

$("#btnAgregar").on('click', showPanelAgregar);
$("#btnCerrar").on('click', hidePanelAgregar);
$("#imprimirCodigo").on('click', PrintBarCode);

$('#form').submit(
    function(event)
    {
        setInventarioInicial();
        return true;
    }

);

$(document).on('click', '.Editar', 
    function()
    {
        editar($(this).data('id'));
    }
);
$(document).on('click',  ".Desactivar",
    function()
    {
        desactivar($(this).data('id'));
    }
);

$(document).on('click',  ".codigoBarras",
    function()
    {
        JsBarcode("#barcode", $(this).data('code'));
    }
);



function showPanelAgregar(isCreate = true)
{
    $("#panelAgregar").show(500);
    if(isCreate)
    {
        $('#form').trigger("reset");
        $('#setInventario').show();
        $('#form').attr("action", "/productos/nuevo");
        $('#guardar').text("Guardar");

    }
}

function hidePanelAgregar()
{
    $("#panelAgregar").hide(500);
}

function editar(id)
{
    $.get( "/productos/get/"+ id)
    .done(function( data ) {
        for(var key in data)
        {
            $('#form').find('#'+key).val(data[key]);
        }
        showPanelAgregar(false);
        $('#idProducto').val(id);
        $('#setInventario').hide();
        $('#guardar').text("editar");
        $('#form').attr("action", "/productos/editar");
    });
}

function desactivar(id)
{
    if(confirm("Seguro que desea desactivar este producto"))
    {
        $("#idProductoCambioStatus").val(id);
        $("#formDesactivar").submit();
        
    }
    
}


function  setInventarioInicial()
{
    var inventarioInicial = {};
    $(".inventarioSucursal").each(function()
    {
        var idSucursal = $(this).data("idsucursal");
        inventarioInicial[idSucursal] = $(this).val();
    });
    $("#dataInventarioInicial").val(JSON.stringify(inventarioInicial));
}

$("#urlImagen").bind("paste", function(e){
    // access the clipboard using the api
    $('#imgProducto').html("");
    var pastedData = e.originalEvent.clipboardData.getData('text');
    var img = $('<img />', {src : pastedData}).height(100).width(100);
    img.appendTo('#imgProducto');
   // alert(pastedData);
} );

function PrintBarCode()
{
    var css = "@media print {size: 15cm 15cm;}";
   

    var mywindow = window.open('', 'PrintMap', 'height=100,width=300');

    mywindow.document.write('<html>');
    mywindow.document.write('<head>');
    mywindow.document.write("<style>");
    mywindow.document.write("@page {size: 25cm 35.7cm;   margin: 5mm 5mm 5mm 5mm;}");
    mywindow.document.write("</style>");
    mywindow.document.write('</head>');
    mywindow.document.write('<body>');
    mywindow.document.write('<div style="height:400px;border:1px solid blue;">');
   
    mywindow.document.write($("#barcodeDiv").html());

    mywindow.document.write('</div>');
    mywindow.document.write('</body></html>');

    mywindow.document.close(); // necessary for IE >= 10
    mywindow.focus(); // necessary for IE >= 10*/
//mywindow.open();
    mywindow.print();
    mywindow.close();

    return true;
}
});