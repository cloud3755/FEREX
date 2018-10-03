$("button[id='vender']").click(function (e) {
    e.preventDefault();




    var folio = $($(this).parents("tr").children("td")[0]).text();

    var total = $($(this).parents("tr").children("td")[4]).text();

    total = parseFloat(total);




    $("input#folioModal").val(folio);
    $("input#totalModal").val(total);


    //$('#formCoti').submit();
});

$("button[id='guardarCotizacion']").click(function (e) {
    e.preventDefault();
    var formaPago = $('#formaPago :selected').val();


    $("input#formaPagoModal").val(formaPago);


    $('#formCoti').submit();
});

