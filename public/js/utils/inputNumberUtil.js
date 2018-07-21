
//Agregar el evento al selector
$(document).on("change", ':input[type="number"]', 
    function()
    {
        isNumber($(this));
    }
);
//Agregar el evento al selector
$(document).on("change", ".overCero", 
    function()
    {
        overCero($(this));
    }
);

/**
 * funcion que verifica si un input es mayor que 0
 * 
 */
function overCero(e)
{
    isNumber(e);
    if(e.val()<=0)
        e.val(1)
}

function isNumber(e)
{
    if(parseInt(e.val()) == NaN)
        e.val(0);
}
