$(function(){

    $("#estado").on("change", function(e) { 
      var idEstado=  $(this).find(":selected").data("id");
       $('#ciudad').html("");
       $.get( "/municipios/"+ idEstado)
    .done(function( data ) {
       
        for(var key in data)
        {
            var municipio = data[key]["nombreMunicipio"];
            $('#ciudad').html
            (
                 $('#ciudad').html()+
                '<option value="'+municipio+'">'+municipio+'</option>'
            );
            $('#ciudad').selectpicker('refresh');
        }

    });



});


});