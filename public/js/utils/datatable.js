/** 
 * Funcion para generar dataTable de bootstrap, con ajax
 * @param {string} id - el id de la tabla a generar
 * @param {string} ajaxRoute - la ruta de donde conseguir los datos ajax
 * @param {object} columns - las columnas a acomodar en la tabla en el siguiente formato
 * {data: 'nombreColumna', name: 'nombreColumna'}
*/
function thedataTables($id = "dataTable" ,  ajaxRoute = "", columns="")
{
    dtObject = 
    {
    searching: true,
    pageLength: 5,
    paging: true,
    order: [[ 2, "desc" ]],
    "language":
        {
            sInfo:"Mostrar _START_ a _END_ de _TOTAL_ Registros",
            sLengthMenu: "Mostrar _MENU_ Registros",
            sSearch:"Filtrar:",
            sFirst:"Primero",
            sLast:"Ultimo",
            sNext:"Siguiente",
            sPrevious:"Anterior" 
        }
    }
    if(ajaxRoute)
    {
        dtObject["ajax"] = ajaxRoute;
        dtObject["columns"] = columns;
    }
    
$('#dataTable').DataTable().destroy();
$('#dataTable').DataTable(dtObject);

}

