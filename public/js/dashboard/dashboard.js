google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart);
google.charts.setOnLoadCallback(drawChart1);

google.charts.setOnLoadCallback(drawAxisTickColors);

function drawAxisTickColors() {
      var data = new google.visualization.DataTable();
      data.addColumn('timeofday', 'Time of Day');
      data.addColumn('number', 'Motivation Level');
      data.addColumn('number', 'Energy Level');

      data.addRows([
        [{v: [8, 0, 0], f: '8 am'}, 1, .25],
        [{v: [9, 0, 0], f: '9 am'}, 2, .5],
        [{v: [10, 0, 0], f:'10 am'}, 3, 1],
        [{v: [11, 0, 0], f: '11 am'}, 4, 2.25],
        [{v: [12, 0, 0], f: '12 pm'}, 5, 2.25],
        [{v: [13, 0, 0], f: '1 pm'}, 6, 3],
        [{v: [14, 0, 0], f: '2 pm'}, 7, 4],
        [{v: [15, 0, 0], f: '3 pm'}, 8, 5.25],
        [{v: [16, 0, 0], f: '4 pm'}, 9, 7.5],
        [{v: [17, 0, 0], f: '5 pm'}, 10, 10],
      ]);

      var options = {
        title: 'Motivation and Energy Level Throughout the Day',
        focusTarget: 'category',
        hAxis: {
          title: 'Time of Day',
          format: 'h:mm a',
          viewWindow: {
            min: [7, 30, 0],
            max: [17, 30, 0]
          },
          textStyle: {
            fontSize: 14,
            color: '#053061',
            bold: true,
            italic: false
          },
          titleTextStyle: {
            fontSize: 18,
            color: '#053061',
            bold: true,
            italic: false
          }
        },
        vAxis: {
          title: 'Rating (scale of 1-10)',
          textStyle: {
            fontSize: 18,
            color: '#67001f',
            bold: false,
            italic: false
          },
          titleTextStyle: {
            fontSize: 18,
            color: '#67001f',
            bold: true,
            italic: false
          }
        }
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

         datosMes[i + 1] = [ mes, ventasMes[i].suma ];
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
    title: 'My Daily Activities',
    is3D: true,
  };

  var chart = new google.visualization.PieChart(document.getElementById('piechart_3dd'));
  chart.draw(data, options);
}
