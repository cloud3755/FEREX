var totalFinal = 0;
var arrayGins;
var subTotalArr = new Array();
var contador = 0;
var creditoUsado = 0;
var contadorParaIva = 0;
var porFuera = 0;
var esCotizacion = 0;

$("#precioB.btn").append("  "+$('#Productos :selected').data('preciob'));


$("#precioC.btn").append("  "+$('#Productos :selected').data('precioc'));


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
var folio =nuevaCadena2+ Math.floor(Math.random() * 100000);

if ($("#statusCaja").val() == "NI"){
    alert("No Puedes vender sin iniciar la caja");
    $("#fijarCliente").attr('disabled',true);
}


$("#productosDiv").hide();
$("#productoFuera").hide();
$("#ventaCoti").hide();

$("#agregarEntrada").attr('disabled',true);
$("#pdf").attr('disabled',true);
$("#Procesar").attr('disabled',true);
$("#venderCredito").attr('disabled',true);



$("#pdf").click(function (e) {
    e.preventDefault();



    var formaPago = $('#formaPago :selected').val();

    var saldoActual = $('#statusCaja').data('saldo');



    var cliente = [];
    var idProducto = [];
    var existencia = [];
    var producto = [];
    var cantidad = [];
    var precioProducto = [];
    var subTotal = [];
    var total  = $("#total label").text() ;

    var creditoActual = $('#Cliente :selected').data('creditoactual');

    creditoActual = parseFloat(creditoActual) + parseFloat(creditoUsado);

    if (creditoUsado == 0){

    }
    else {
        formaPago = "Venta a credito";
    }

    if (formaPago == 0 && formaPago !="Venta a credito" ){

        alert("Elija una forma de pago valida");
        return false;
    }
    if (formaPago == "efectivo"){


        saldoActual = parseFloat(saldoActual) + parseFloat(total);
    }
    else {
        saldoActual = parseFloat(saldoActual);
    }



    //$("td[id^='cliente']").each(function(){
    //    var clientes = $(this).data("id");
    var idCliente = $("#Cliente :selected").val();
    cliente.push(idCliente);
    //});

    $("td[id^='descripcion']").each(function(key,value){

        var productos = $(this).text();
        producto.push(productos+",");
        var ids = $(this).data("id");
        idProducto.push(ids);
        var existencias = $(this).data("existencia");
        existencia.push(existencias);



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

    var comentarioPublico = $("#comentarioPublico").val();
    var comentarioPrivado = $("#comentarioPrivado").val();

    // vendedor
    // cliente
    //producto
    //cantidad
    //precioProducto
    //subTotal
    //total
    $("#cotizacion input#cliente").val(cliente);
    $("#cotizacion input#idProdcuto").val(idProducto);
    $("#cotizacion input#existencias").val(existencia);
    $("#cotizacion input#producto").val(producto);
    $("#cotizacion input#cantidad").val(cantidad);
    $("#cotizacion input#precioProducto").val(precioProducto);
    $("#cotizacion input#subTotal").val(subTotal);
    $("#cotizacion input#total").val(total);
    $("#cotizacion input#saldo").val(saldoActual);
    $("#cotizacion input#credito").val(creditoActual);
    $("#cotizacion input#folio").val(folio);
    $("#cotizacion input#formaPago").val(formaPago);
    $("#cotizacion input#comentarioPublico").val(comentarioPublico);
    $("#cotizacion input#comentarioPrivado").val(comentarioPrivado);


    $('#cotizacion').submit();
    location.reload();

});

$("#nuevoCliente").click(function (e) {
    e.preventDefault();

});

$("#productoFuera").click(function (e) {
    e.preventDefault();

    $("#productosDiv").hide();
    $("#productoFuera").hide();


    $("#productoFueraDiv").append('<div id="fueraTemporal"> nombre <input id="nombreFuera" type="text"> </input>  Precio<input id="precioFuera" type="text"> </div>');
    porFuera = 1;
});
$("#reset").click(function (e) {
    e.preventDefault();

    if(confirm('¿Estas seguro que deceas cancelar esta venta?')){
        location.reload();
    }

else
    {
        return false;
    }


});


$("#Productos").change(function (e) {
    $("#precioB.btn").text("Precio B");
    $("#precioC.btn").text("Precio C");

    $("#precioB.btn").append("  "+$('#Productos :selected').data('preciob'));


    $("#precioC.btn").append("  "+$('#Productos :selected').data('precioc'));



});

$("#IVA").click (function (e) {
    e.preventDefault();
    contadorParaIva ++;

    if (contadorParaIva %2 == 1) {
        $("td[id^='precio']").each(function () {

            $(this).text(parseInt($(this).text()) + parseInt(($(this).text() * .16)));
        });


        $("td[id^='codigoBarras']").each(function () {


            var tamañoCadena = $(this).attr("id").length;

            var fila = $(this).attr("id")[tamañoCadena - 1];
            var precio = parseFloat($("#precio" + fila).text());
            var cantidad = $("#cantidad2" + fila).val();
            var subTotal = precio * cantidad;
            $("#subTotal" + fila).val(subTotal);
            $("#subTotal" + fila).text(subTotal);


            $("td[id^='subTotal']").each(function () {
                totalFinal = totalFinal + eval($(this).text());
                $("#total label").text(totalFinal);
            });


            totalFinal = 0;
            $("#IVA").text("Cancelar IVA");
            $("#IVA").attr('class', 'btn btn-danger');

        });
    }
    else{
        $("td[id^='precio']").each(function () {

            $(this).text($(this).data('precioiva'));
        });


        $("td[id^='codigoBarras']").each(function () {


            var tamañoCadena = $(this).attr("id").length;

            var fila = $(this).attr("id")[tamañoCadena - 1];
            var precio = parseFloat($("#precio" + fila).text());
            var cantidad = $("#cantidad2" + fila).val();
            var subTotal = precio * cantidad;
            $("#subTotal" + fila).val(subTotal);
            $("#subTotal" + fila).text(subTotal);


            $("td[id^='subTotal']").each(function () {
                totalFinal = totalFinal + eval($(this).text());
                $("#total label").text(totalFinal);
            });


            totalFinal = 0;
            $("#IVA").text("Aplicar IVA");
            $("#IVA").attr('class', 'btn btn-primary');

        });


    }

});
$("#fijarCliente").click(function (e) {
    e.preventDefault();

    $('#Cliente').attr('disabled',true);
    //$("#agregarEntrada").attr('disabled',false);
    //$("#productosDiv").show();
    $("#ventaCoti").show();


});

$("#fijarVenta").click(function (e) {
    e.preventDefault();

     //$('#Cliente').attr('disabled',true);
    $("#agregarEntrada").attr('disabled',false);
    $("#productosDiv").show();
    $("#productoFuera").show();

    $("#ventaCoti").hide();
    $("#pdf").hide();

});

$("#fijarCotizacion").click(function (e) {
    e.preventDefault();

    //$('#Cliente').attr('disabled',true);
    $("#agregarEntrada").attr('disabled',false);
    $("#productosDiv").show();
    $("#productoFuera").show();
    $("#ventaCoti").hide();
    $("#Procesar").hide();
    $("#venderCredito").hide();
    $("#IVA").hide();
    $('#formaPago :selected').val("cotizacion");
    $("#formaPagoSelect").hide();
    esCotizacion = 1;
});


$("#precioB.btn").click(function (e) {
    e.preventDefault();
    var precioB = $('#Productos :selected').data('preciob');

$('#Productos :selected').val(precioB);


});
$("#precioC.btn").click(function (e) {
    e.preventDefault();
    var precioC = $('#Productos :selected').data('precioc');

    $('#Productos :selected').val(precioC);


});
$( "#venderCredito" ).click(function(e) {
    e.preventDefault();


    var limiteCredito = $('#Cliente :selected').data('limitecredito');
    var creditoActual = $('#Cliente :selected').data('creditoactual');

    limiteCredito = limiteCredito - creditoActual;
    if($("#total label").text()  > limiteCredito){
        alert("Tu limite de credito es"+ limiteCredito);
        return false;
    }
    else {
        creditoUsado = parseFloat($("#total label").text());
        submitForm();
    }
});



$(function(){
    $('body').keyup(function(e) {
        if(e.which == 13 && $("#comentarioPublico").val()=="" && $("#comentarioPrivado").val()==""){

            $(".producto > button").click();
            agregarRegistro();
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

    $("#pdf").attr('disabled',false);
    $("#Procesar").attr('disabled',false);
    $("#venderCredito").attr('disabled',false);

    var gin = $('#Cliente').val();
    var cliente = $('#Cliente :selected').data('descripcion');
    var clienteId = $('#Cliente :selected').data('id');
    var cantidad = $('#cantidad').val();
    var arrayGin = {};
    if (porFuera == 1){
        var idProducto = 0;
        var descripcion = $('#nombreFuera').val();
        var codigoBarras = "" ;
        var precio = $('#precioFuera').val();
        var existencia = 10000;
        $("#productosDiv").show();
        $("#productoFuera").show();
        $('#fueraTemporal').remove();

        porFuera =0;
    }
    else {


        var idProducto = $('#Productos :selected').data('id');
        var descripcion = $('#Productos :selected').data('descripcion');
        var codigoBarras = $('#Productos :selected').data('codigo');
        var precio = $('#Productos :selected').val();
        var existencia = $('#Productos :selected').data('existencia');
    }
    var subTotal = cantidad *  precio;



    if (existencia < cantidad  && esCotizacion == 0){

        alert("Solo quedan "+existencia+" "+ descripcion);
        return false;
    }



    if (cantidad >0){
        var productoSelecionado = $(".producto :selected").data("id");
        var cantidadSelecionada= $("#cantidad").val();
        $("td[id^='descripcion']").each(function(){

            var productoAgregado = $(this).data("id");


            if(productoSelecionado == productoAgregado){

                var tamañoCadena =  $(this).attr("id").length;

                var fila =  $(this).attr("id")[tamañoCadena-1];
                var cantidadAgregada = $("#cantidad2"+fila).val();
                cantidadSelecionada =  parseFloat(cantidadSelecionada);
                cantidadAgregada =   parseFloat(cantidadAgregada);
                var sumarCantidad = cantidadSelecionada +  cantidadAgregada;


                $("#cantidad2"+fila).val(sumarCantidad);
                var precio = parseFloat($("#precio"+fila).text());
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

        '<td data-id="'+clienteId+'" id="cliente'+contador+'">'+cliente+'</td>'+
        '<td  id="codigoBarras'+contador+'">'+codigoBarras+'</td>'+
        '<td  id="descripcion'+contador+'" data-existencia = '+existencia+'  data-id = '+ idProducto + '  id="descripcion'+contador+'">'+descripcion+'</td>'+
        '<td id="cantidad'+contador+'"><input class="Cantidad overCero" data-existencia='+existencia+' type="number" id="cantidad2'+contador+'" value="'+cantidad+'" /></td>'+
        '<td data-precioiva='+precio+' id="precio'+contador+'">'+precio+'</td>'+
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



        var precio = parseFloat($("#precio"+fila).text());
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
cantidad = parseFloat(cantidad);
    var exitenciaPorFila = e.data("existencia");

    if(cantidad > 0){

    }

    else {
        alert("No puede ir esa cantidad");
        e.val(1);
        e.off( event );
    }


    if(exitenciaPorFila < cantidad && esCotizacion == 0){
        alert("sobre pasa tu inventario");
        e.val(exitenciaPorFila);
        e.off( event );
    }
   var tamañoCadena = e.attr("id").length;

   var fila =  e.attr("id")[tamañoCadena-1];



    var precio = parseFloat($("#precio"+fila).text());
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


    $("td[id^='codigoBarras']").each(function(){
        var tamañoCadena =  $(this).attr("id").length;

        var fila =  $(this).attr("id")[tamañoCadena-1];
        var precio = parseFloat($("#precio"+fila).text());
        var cantidad = $("#cantidad2"+fila).val();
        var subTotal =   precio * cantidad;
        $("#subTotal"+fila).val(subTotal);
        $("#subTotal"+fila).text(subTotal);


        $("td[id^='subTotal']").each(function(){
            totalFinal = totalFinal + eval($(this).text());
            $("#total label").text(totalFinal);
        });




        totalFinal = 0;

    });






}

function submitForm()
{
    //base_64
  // var atata =  $('#datosEntrada').val(JSON.stringify(arrayGins));
    //$('#id_sucursal').val($('#sucursal').val());
    //alert($('#sucursal').val());return;

    var formaPago = $('#formaPago :selected').val();

    var saldoActual = $('#statusCaja').data('saldo');

    var comentarioPublico = $("#comentarioPublico").val();
    var comentarioPrivado = $("#comentarioPrivado").val();

    var cliente = [];
    var idProducto = [];
    var existencia = [];
    var producto = [];
    var cantidad = [];
    var precioProducto = [];
    var subTotal = [];
    var total  = $("#total label").text() ;

    var creditoActual = $('#Cliente :selected').data('creditoactual');

    creditoActual = parseFloat(creditoActual) + parseFloat(creditoUsado);

    if (creditoUsado == 0){

    }
    else {
        formaPago = "Venta a credito";
    }

    if (formaPago == 0 && formaPago !="Venta a credito" ){

        alert("Elija una forma de pago valida");
        return false;
    }
    if (formaPago == "efectivo"){


        saldoActual = parseFloat(saldoActual) + parseFloat(total);
    }
    else {
        saldoActual = parseFloat(saldoActual);
    }



    //$("td[id^='cliente']").each(function(){
    //    var clientes = $(this).data("id");
    var idCliente = $("#Cliente :selected").val();
    cliente.push(idCliente);
    //});

    $("td[id^='descripcion']").each(function(key,value){

        var productos = $(this).text();
        producto.push(productos+",");
        var ids = $(this).data("id");
        idProducto.push(ids);
        var existencias = $(this).data("existencia");
        existencia.push(existencias);



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
    var tipoImpresion = $("<input>")
               .attr("type", "hidden")
               .attr("name", "tipoImpresion").val($("input:radio[name='tipoImpresion']:checked").val());
    $('#form').append(tipoImpresion);
    $("#form input#cliente").val(cliente);
    $("#form input#idProdcuto").val(idProducto);
    $("#form input#existencias").val(existencia);
    $("#form input#producto").val(producto);
    $("#form input#cantidad").val(cantidad);
    $("#form input#precioProducto").val(precioProducto);
    $("#form input#subTotal").val(subTotal);
    $("#form input#total").val(total);
    $("#form input#saldo").val(saldoActual);
    $("#form input#credito").val(creditoActual);
    $("#form input#folio").val(folio);
    $("#form input#formaPago").val(formaPago);
    $("#form input#comentarioPublico").val(comentarioPublico);
    $("#form input#comentarioPrivado").val(comentarioPrivado);



    $('#form').submit();
}