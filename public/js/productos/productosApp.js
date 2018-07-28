
$(function(){
thedataTables("dataTable", '/productos/get',
[
    {data: 'nombre', name: 'nombre'},
    {data: 'descripcion', name: 'descripcion'},
    {data: 'claveProdServ', name: 'claveProdServ'},
    {data: 'precioA', name: 'precioA'},
    {data: 'Acciones', name: 'Acciones', orderable: false, searchable: false}
    
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
$(".Desactivar").on('click', 
    function()
    {
        desactivar($(this).data('id'));
    }
);

function showPanelAgregar()
{
    $("#panelAgregar").show(500);
    //$('form').reset
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
            $('form').find('#'+key).val(data[key]);
        }
        showPanelAgregar();
    });
}

function desactivar(id)
{
    alert(id);  
}

});