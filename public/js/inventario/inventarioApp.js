$(function(){

    $('#agregarInventario').on('click', agregarRegistro);
    $('#procesarInventario').on('click', submitForm);
});



function agregarRegistro()
{
    var idProducto = $('#Productos').val();
    cantidad = parseInt($('#Cantidad').val());
    //buscamos si ya se agrego el producto anteriormente
    if($('#tableEntrada tbody').find("#tr"+idProducto).length)
    {
        var cantidadDOM = $('#tableEntrada tbody').find("#tr"+idProducto).find('.Cantidad');
        $(cantidadDOM).val(parseInt($(cantidadDOM).val())+ cantidad);
        return;
    }
    var cantidad;  

    var descripcion = $('#Productos :selected').data('descripcion');
    var producto = $('#Productos :selected').text();
    cantidad = $('#Cantidad').val();
    var sucursal =  $('#Sucursal').text();
    var idSucursal = $('#Sucursal :selected').data('id');
    var buttonDelete = '<button data-id='+idProducto+' class="removeProducto">x</button>';

    $('#tableEntrada tbody').append(
        '<tr class="trProducto" id="tr'+idProducto+'">'+
            '<td class="idProducto" data-id="'+idProducto+'">'+producto+'</td>'+
            '<td>'+descripcion+'</td>'+
            '<td ><input class="Cantidad overCero" type="number" value="'+cantidad+'" /></td>'+
            '<td class="idSucursal" data-id="'+idSucursal+'">'+sucursal+'</td>'+
            '<td>'+buttonDelete+'</td>'+
        '</tr">'
    );
    $('.removeProducto').on('click', function(){quitarfila($(this));});
}

function quitarfila(e)
{
    idProducto = e.data('id');
    $('#tr'+idProducto).remove();
}

function submitForm()
{
    var arrayInventario = [];
    $('.trProducto').each
    (
        function()
        {
            idSucursal = $(this).find('.idSucursal').data('id');
            idProducto = $(this).find('.idProducto').data('id');
            cantidad = $(this).find('.Cantidad').val();
            arrayInventario.push({
                idSucursal, 
                idProducto, 
                cantidad});
        }
    );
    
    $('#datosInventario').val(JSON.stringify(arrayInventario));
    //$('#id_sucursal').val($('#sucursal').val());
    //alert($('#sucursal').val());return;
    $('#form').submit();
}