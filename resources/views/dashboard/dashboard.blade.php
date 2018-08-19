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
                            <div>Historial de clientes</div>
                        </div>
                    </div>
                </div>
                <a href="#" data-toggle="modal" data-target="#exampleModal" >
                    <div class="panel-footer">
                        <span class="pull-left" >  Ver detalle</span>
                        <span class="pull-right"><i class="fa fa-arrow-circle-right" ></i></span>
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

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Hstorial de clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover">
            <thead>
              <tr>
                <th>Nombre cliente</th>
                <th>Numero de Compras</th>
                <th>Ttotal de compras</th>
                <th>Limite de credito</th>
              </tr>
            </thead>
            <tbody>
              @foreach($detalleCliente as $clientes)
              <tr>
                <td>{{$clientes->nombre}}</td>
                <td>{{$clientes->total_compras}}</td>
                <td>{{$clientes->Compra}}</td>
                <td>{{$clientes->limite}}</td>
              </tr>
              @endforeach
            </tbody>
        </table>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<!-- SE PASA EL ARREGLO GLOBAL A LOS ARREGLOS -->
<?php
  $graficaTotalVentas=json_encode($ventasMes);

 ?>

 <script type="text/javascript">
  var ventasMes = eval(<?php echo $graficaTotalVentas ?>);
 </script>

@endsection
  @section('scripts.personalizados')
  @parent
    <script src="{{ asset('js/productos/productosApp.js') }}"></script>
    <script src="{{ asset('js/dashboard/dashboard.js') }}"></script>
  @endsection
