var totalFinal = 0;
var arrayGins;
var subTotalArr = new Array();
var contador = 0;
arrayGins = {};

var d = new Date();
var month = d.getMonth()+1;
var day = d.getDate();
var output = d.getFullYear() + '/' +
    (month<10 ? '0' : '') + month + '/' +
    (day<10 ? '0' : '') + day;
var nuevaCadena = output.replace("/", "");
var nuevaCadena2 = nuevaCadena.replace("/", "");

var folio =nuevaCadena2+ Math.floor(Math.random() * 100000);



$(function(){
    $('body').keyup(function(e) {
        if(e.which == 13){
            agregarRegistro();
            $(".producto > button").click();
        }
    });

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
    var existencia = $('#Productos :selected').data('existencia');
    var subTotal = cantidad *  precio;


    if (existencia < cantidad ){

        alert("Solo quedan "+existencia+" "+ descripcion);
        return false;
    }

    if (cantidad >0){
        var productoSelecionado = $(".producto :selected").data("codigo");
        var cantidadSelecionada= $("#cantidad").val();
        $("td[id^='codigoBarras']").each(function($key){

            var productoAgregado = $(this).text();


            if(productoSelecionado == productoAgregado){
                var cantidadAgregada = $("#cantidad2"+$key).val();
                cantidadSelecionada =  parseInt(cantidadSelecionada);
                cantidadAgregada =   parseInt(cantidadAgregada);
                var sumarCantidad = cantidadSelecionada +  cantidadAgregada;


                $("#cantidad2"+$key).val(sumarCantidad);


                var tamañoCadena =  $(this).attr("id").length;

                var fila =  $(this).attr("id")[tamañoCadena-1];



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

               agregarRegistro.off( event );
            }


        });
    }

    else {
        alert("No puede ir esa cantidad")
        return false;
    }

    var buttonDelete = '<button data-gin='+codigoBarras+' class="removegin">x</button>';
    arrayGin['cliente'] = cliente;
    arrayGin['codigoBarras'] = codigoBarras;
    arrayGin['descripcion'] = descripcion;
    arrayGin['cantidad'] = cantidad;
    arrayGin['precio'] = precio;
    arrayGin['subTotal'] = subTotal;


    arrayGins[cliente] = arrayGin;





    $('#tableEntrada tbody').append(
        '<tr class="trCliente" id="'+codigoBarras+'">'+

        '<td id="cliente'+contador+'">'+cliente+'</td>'+
        '<td id="codigoBarras'+contador+'">'+codigoBarras+'</td>'+
        '<td id="descripcion'+contador+'">'+descripcion+'</td>'+
        '<td id="cantidad'+contador+'"><input class="Cantidad overCero" data-existencia='+existencia+' type="number" id="cantidad2'+contador+'" value="'+cantidad+'" /></td>'+
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


        var tamañoCadena =  $(".Cantidad").attr("id").length;

        var fila =  $(".Cantidad").attr("id")[tamañoCadena-1];



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
        contador++;
    }






    $('.removegin').on('click', function(){quitarfila($(this));});

    $('.Cantidad').on('change',function(){cantidadChange($(this));});
}




function cantidadChange(e)
{


    var cantidad = e.val();
cantidad = parseInt(cantidad);
    var exitenciaPorFila = e.data("existencia");

    if(cantidad > 0){

    }

    else {
        alert("No puede ir esa cantidad");
        e.val(1);
        e.off( event );
    }

    if(exitenciaPorFila < cantidad){
        alert("sobre pasa tu inventario");
        e.val(exitenciaPorFila);
        e.off( event );
    }
   var tamañoCadena = e.attr("id").length;

   var fila =  e.attr("id")[tamañoCadena-1];



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


   var idFila = e.data("gin");

    $('#'+idFila).remove();
}

function submitForm()
{
    //base_64
  // var atata =  $('#datosEntrada').val(JSON.stringify(arrayGins));
    //$('#id_sucursal').val($('#sucursal').val());
    //alert($('#sucursal').val());return;

var cliente = [];
var producto = [];
var cantidad = [];
var precioProducto = [];
var subTotal = [];
var total  = $("#total label").text() ;
    $("td[id^='cliente']").each(function(){
        var clientes = $(this).text();

        cliente.push(clientes);
    });

    $("td[id^='descripcion']").each(function(key,value){

        var productos = $(this).text();
        producto.push(productos);

    });
    $('.Cantidad').each(function(key,value){

        var cantidades = $(this).val() ;
        cantidad.push(cantidades);
    });

    $("td[id^='precio']").each(function(key,value){

        var precioProductos = $(this).text() ;
        precioProducto.push(precioProductos);
    });

    $("td[id^='subTotal']").each(function(key,value){

        var subTotals = $(this).text() ;
        subTotal.push(subTotals);
    });


    // vendedor
   // cliente
    //producto
    //cantidad
    //precioProducto
    //subTotal
    //total
    $("#form input#cliente").val(cliente);
    $("#form input#producto").val(producto);
    $("#form input#cantidad").val(cantidad);
    $("#form input#precioProducto").val(precioProducto);
    $("#form input#subTotal").val(subTotal);
    $("#form input#total").val(total);
    $("#form input#folio").val(folio);
    folio
    $('#form').submit();
}