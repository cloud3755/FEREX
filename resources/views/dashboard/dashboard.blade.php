@extends('layouts.app')
@section('styles')
  @parent
@endsection
@section('content')

<script type="text/javascript">
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
    var data = google.visualization.arrayToDataTable([
      ['Year', 'Sales', 'Expenses'],
      ['2013',  1000,      400],
      ['2014',  1170,      460],
      ['2015',  660,       1120],
      ['2016',  1030,      540]
    ]);

    var options = {
      title: 'Company Performance',
      hAxis: {title: 'Year',  titleTextStyle: {color: '#333'}},
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
</script>

<div class="panel panel-primary"><center><h1>  Estadisticas </h1></center>      </div>
<div class="container">
    <div class="col-sm-12">
      <div class="row">
        <div class="col-lg-3 col-md-6">
              <div class="panel panel-primary">
                  <div class="panel-heading">
                      <div class="row">
                          <div class="col-xs-3">
                              <i class="fa fa-comments fa-5x"></i>
                          </div>
                          <div class="col-xs-9 text-right">
                              <div class="huge">26</div>
                              <div>Total de ventas</div>
                          </div>
                      </div>
                  </div>
                  <a href="#">
                      <div class="panel-footer">
                          <span class="pull-left">Ver detalle</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-green">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-tasks fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">12</div>
                            <div>Ventas por vendedor</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalle</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-yellow">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-shopping-cart fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">124</div>
                            <div>Top de cliente</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalle</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
        <div class="col-lg-3 col-md-6">
            <div class="panel panel-red">
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-3">
                            <i class="fa fa-support fa-5x"></i>
                        </div>
                        <div class="col-xs-9 text-right">
                            <div class="huge">13</div>
                            <div>Productos mas vendidos</div>
                        </div>
                    </div>
                </div>
                <a href="#">
                    <div class="panel-footer">
                        <span class="pull-left">Ver detalles</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                        <div class="clearfix"></div>
                    </div>
                </a>
            </div>
        </div>
      </div>

      <div style="height:100%;">
          <div class="row">

            <div class="col-md-6">
              <div id="chart_div" style="width: 100%; height: 60vh;"></div>
            </div>

            <div class="col-lg-6">
              <div id="piechart_3dd" style="width: 100%; height: 30vh;"></div>
            </div>

            <div class="col-lg-6">
              <div id="chart_div1" style="width: 100%; height: 30vh;"></div>
            </div>

          </div>
      </div>

    </div>
</div>


@endsection
  @section('scripts.personalizados')
  @parent
    <script src="{{ asset('js/productos/productosApp.js') }}"></script>
  @endsection
