var totalFinal = 0;
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

        '<td id="cliente'+contador+'">'+cliente+'</td>'+
        '<td id="codigoBarras'+contador+'">'+codigoBarras+'</td>'+
        '<td id="descripcion'+contador+'">'+descripcion+'</td>'+
        '<td id="cantidad'+contador+'"><input class="Cantidad overCero" type="number" id="cantidad2'+contador+'" value="'+cantidad+'" /></td>'+
        '<td id="precio'+contador+'">'+precio+'</td>'+
        '<td id="subTotal'+contador+'">'+subTotal+'</td>'+
        '<td>'+buttonDelete+'</td>'+
        '</tr">'
    );


    subTotalArr[contador] =  subTotal;

    if(contador==0){
        var total = subTotalArr[contador];

        $('#total label').append(
            total
        );

        contador++;


    }
    else{
        var total = subTotalArr[contador]+subTotalArr[contador-1];
        $("#total label").text(total);
        contador++;
    }






    $('.removegin').on('click', function(){quitarfila($(this));});
    $('.Cantidad').on('change',function(){cantidadChange($(this));});
}

function cantidadChange(e)
{
    var gin = e.parent().parent().attr('id');
    arrayGins[gin]['cantidad'] = e.val();
    console.log(arrayGins);


   var tamañoCadena = e.attr("id").length;

   var fila =  e.attr("id")[tamañoCadena-1];

    console.log(fila);

    var precio = parseInt($("#precio"+fila).text());
    var cantidad = $("#cantidad2"+fila).val();
    var subTotal =   precio * cantidad;
    $("#subTotal"+fila).val(subTotal);
    $("#subTotal"+fila).text(subTotal);



    $("td[id^='subTotal']").each(function(){
        totalFinal = totalFinal + eval($(this).text());
        $("#total label").text(totalFinal);
    });




    totalFinal = 0;
    e.off( event );

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