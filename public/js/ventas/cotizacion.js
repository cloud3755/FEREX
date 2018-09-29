$("button[id='vender']").click(function (e) {
    e.preventDefault();




    var folio = $($(this).parents("tr").children("td")[0]).text();


    $("input#folioModal").val(folio);


    //$('#formCoti').submit();
});

$("button[id='guardarCotizacion']").click(function (e) {
    e.preventDefault();
    var formaPago = $('#formaPago :selected').val();


    $("input#formaPagoModal").val(formaPago);


    $('#formCoti').submit();
});

