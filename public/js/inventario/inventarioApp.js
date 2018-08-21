$(function(){

    $('#agregarInventario').on('click', agregarRegistro);
   
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
    var producto = $('#Productos').text();
    cantidad = $('#Cantidad').val();
    var sucursal =  $('#Sucursal').text();
    var buttonDelete = '<button data-id='+idProducto+' class="removeProducto">x</button>';

    $('#tableEntrada tbody').append(
        '<tr class="trProducto" id="tr'+idProducto+'">'+
            '<td>'+producto+'</td>'+
            '<td>'+descripcion+'</td>'+
            '<td ><input class="Cantidad overCero" type="number" value="'+cantidad+'" /></td>'+
            '<td>'+sucursal+'</td>'+
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
    
}