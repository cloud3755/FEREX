
$(function(){
thedataTables("dataTable", '/sucursales/get',
[
    {data: 'Acciones', name: 'Acciones', orderable: false, searchable: false},
    {data: 'id', name: 'id'},
    {data: 'nombre', name: 'nombre'}

]
);

$("#btnAgregar").on('click', showPanelAgregar);
$("#btnCerrar").on('click', hidePanelAgregar);

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
});