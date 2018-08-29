$(function()
{
    $(".cambioStatus").on('click', function(){
        cambioStatus($(this));
    });
    
    function cambioStatus(e)
    {
        var saldo = $("#saldo").val();
        var idCaja = e.data("id-caja");
        var operacion = e.data('id-operacion');
        $("#datosCaja").val(JSON.stringify({saldo, idCaja, operacion}));
        $("#form").submit();
    }
}
)