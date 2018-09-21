
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
        $('#form').attr("action", "/sucursales/nuevo");
        $('#guardar').text("Guardar");

    }
}

function hidePanelAgregar()
{
    $("#panelAgregar").hide(500);
}

function editar(id)
{
    $.get( "/sucursales/get/"+ id)
    .done(function( data ) {
        data = JSON.parse(data);console.log(data);
        var idDireccion = data.idDireccion;
        alert(idDireccion);
        for(var key in data)
        {
            
            $('#form').find('#'+key).val(data[key]);
        }alert(data);
        showPanelAgregar(false);
        $('#idSucursal').val(id);
        $('#idDireccion').val(idDireccion);
        $('#guardar').text("editar");
        $('#form').attr("action", "/sucursales/editar");
    }).fail(function(data){console.log(data)});
}

function desactivar(id)
{
    if(confirm("Seguro que desea desactivar esta sucursal"))
    {
        $("#idProductoCambioStatus").val(id);
        $("#formDesactivar").submit();
        
    }
    
}

});