@extends('layouts.app')
@section('styles')
  @parent
@endsection
@section('content')

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

<?php
  $graficaTotalVentas=json_encode($ventasMes);

 ?>

 <script type="text/javascript">

 function drawChart() {

   var ventasMes = eval(<?php echo $graficaTotalVentas ?>);
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

 </script>

@endsection
  @section('scripts.personalizados')
  @parent
    <script src="{{ asset('js/productos/productosApp.js') }}"></script>
    <script src="{{ asset('js/dashboard/dashboard.js') }}"></script>
  @endsection
