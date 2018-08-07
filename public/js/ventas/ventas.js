
var arrayGins;
var subTotalArr = new Array();
var contador = 0;
$(function(){
    arrayGins = {};
    $('#agregarEntrada').on('click', agregarRegistro);
    $('#Procesar').on('click', submitForm);
    $('.removegin').on('click', function(){
        quitarfila($(this));
    });

});



function agregarRegistro()
{
    var gin = $('#Cliente').val();
    var cliente = $('#Cliente :selected').data('descripcion');
    var cantidad = $('#cantidad').val();
    var arrayGin = {};
    var descripcion = $('#Productos :selected').data('descripcion');
    var codigoBarras = $('#Productos :selected').data('codigo');
    var precio = $('#Productos :selected').val();

    var subTotal = cantidad *  precio;




    var buttonDelete = '<button data-gin='+gin+' class="removegin">x</button>';


    arrayGin['gin'] = gin;
    arrayGin['descripcion'] = descripcion;
    arrayGin['cliente'] = cliente;
    arrayGin['cantidad'] = cantidad;
    arrayGin['codigoBarras'] = codigoBarras;
    arrayGin['precio'] = precio;
    arrayGin['subTotal'] = subTotal;

    console.log(arrayGin);
    arrayGins[gin] = arrayGin;
    console.log(arrayGins);
    $('#tableEntrada tbody').append(
        '<tr class="trGin" id="'+gin+'">'+

        '<td id="cliente">'+cliente+'</td>'+
        '<td id="codigoBarras">'+codigoBarras+'</td>'+
        '<td id="descripcion">'+descripcion+'</td>'+
        '<td id="cantidad"><input class="Cantidad overCero" type="number" id="cantidad2" value="'+cantidad+'" /></td>'+
        '<td id="precio">'+precio+'</td>'+
        '<td id="subTotal">'+subTotal+'</td>'+
        '<td>'+buttonDelete+'</td>'+
        '</tr">'
    );


    subTotalArr[contador] =  subTotal;

    var total = subTotalArr[contador]+subTotalArr[contador-1];
contador++;



    $('#total label').append(
        total
    );
    $('.removegin').on('click', function(){quitarfila($(this));});
    $('.Cantidad').on('change',function(){cantidadChange($(this));});
}

function cantidadChange(e)
{
    var gin = e.parent().parent().attr('id');
    arrayGins[gin]['cantidad'] = e.val();
    console.log(arrayGins);


    var precio = parseInt($("#precio").text());
    var cantidad = $("#cantidad2").val();
    var subTotal =   precio * cantidad;

    $("#subTotal").val(subTotal);
    $("#subTotal").text(subTotal);
}

function quitarfila(e)
{
    gin = e.data('gin');

    $('#'+gin).remove();
    delete arrayGins[gin];

}

function submitForm()
{
    //base_64
    $('#datosEntrada').val(JSON.stringify(arrayGins));
    $('#id_sucursal').val($('#sucursal').val());
    //alert($('#sucursal').val());return;
    $('#form').submit();
}