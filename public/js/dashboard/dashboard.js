google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawChart1);

google.charts.setOnLoadCallback(drawAxisTickColors);

function drawAxisTickColors() {

  var datosVendedor = new Array();
  datosVendedor[0] = ['Vendedor', 'Ventas','Total'];

  for (var i = 0; i < ventasVendedor.length; i++)
  {
    datosVendedor[i+1] = [ ventasVendedor[i].name, parseInt(ventasVendedor[i].numeroVentas),parseFloat(ventasVendedor[i].ventas) ];
  }


  var data = google.visualization.arrayToDataTable(datosVendedor,false);


    var options = {
      title: 'Ventas por vendedor',
      hAxis: {title: 'Ventas',  titleTextStyle: {color: '#333'}},
      vAxis: {minValue: 0}
    };


      var chart = new google.visualization.ColumnChart(document.getElementById('chart_div1'));
      chart.draw(data, options);
    }

    function drawChart() {
      var mes = 'Sin mes';

      var datosMes = new Array();
      datosMes[0] = ['Mes', 'Ventas'];

      for (var i = 0; i < ventasMes.length; i++)
       {

         if (ventasMes[i].mes == 1) {mes = 'Enero';}
         else if (ventasMes[i].mes == 2) {mes = 'Febrero';}
         else if (ventasMes[i].mes == 3) {mes = 'Marzo';}
         else if (ventasMes[i].mes == 4) {mes = 'Abril';}
         else if (ventasMes[i].mes == 5) {mes = 'Mayo';}
         else if (ventasMes[i].mes == 6) {mes = 'Junio';}
         else if (ventasMes[i].mes == 7) {mes = 'Julio';}
         else if (ventasMes[i].mes == 8) {mes = 'Agosto';}
         else if (ventasMes[i].mes == 9) {mes = 'Septiembre';}
         else if (ventasMes[i].mes == 10) {mes = 'Octubre';}
         else if (ventasMes[i].mes == 11) {mes = 'Noviembre';}
         else if (ventasMes[i].mes == 12) {mes = 'Diciembre';}

         datosMes[i+1] = [ mes, parseFloat(ventasMes[i].suma) ];
       }


      var data = google.visualization.arrayToDataTable(datosMes,false);

      var options = {
        title: 'Ventas por mes',
        hAxis: {title: 'Ventas',  titleTextStyle: {color: '#333'}},
        vAxis: {minValue: 0}
      };

      var chart = new google.visualization.AreaChart(document.getElementById('chart_div'));
      chart.draw(data, options);
    }

function drawChart1() {
  var data = google.visualization.arrayToDataTable([
    ['Task', 'Hours per Day'],
    ['Work',     11],
    ['Eat',      2],
    ['Commute',  2],
    ['Watch TV', 2],
    ['Sleep',    7]
  ]);

  var options = {
    title: 'Productos mas vendidos',
    is3D: true,
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechart_3dd'));
  chart.draw(data, options);
}
