$(function()
{
    $(".InicioCaja").on('click', function(){
        cambioStatus
        (
            $(this).data("id-caja"),
            $("#saldo").val(),
            $(this).data('id-operacion'),
            0
        );
    });
    $(".corteArqueo").on("click", function(){

        var caja = $(this).data('caja');
        var sucursal =  $(this).data('sucursal');
        var idCaja = $(this).data("id-caja");
        var operacion = $(this).data("id-operacion");
        var operacionNombre = $(this).data("operacion");
        var saldo = $(this).data("saldo");
        $("#saldoActualLabel").text(saldo);
        $("#operacionCaja").text(operacionNombre);
        $("#modalCajaLabel").text("Caja "+ caja + " sucursal " +sucursal);
        $("#modalCambioCaja").modal();
        $("#datosCaja").val(JSON.stringify({saldo, idCaja, operacion}));
    
    });
    $("#operacionCaja").on('click', function(){

        let datosCaja = JSON.parse($("#datosCaja").val());
        cambioStatus(
            datosCaja.idCaja, datosCaja.saldo, datosCaja.operacion,$("#saldoReal").val() 
        )
        
    })
    function cambioStatus(idCaja, saldo, operacion, saldoCapturado)
    {
        $("#datosCaja").val(JSON.stringify({saldo, idCaja, operacion, saldoCapturado}));
        $("#form").submit();
    }

    
}
)