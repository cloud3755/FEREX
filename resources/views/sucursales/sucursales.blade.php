@extends('layouts.app')
@section('styles')
  @parent
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <span>Nueva Sucursal</span>
                  <button id="btnAgregar" class="btn btn-success">Agregar</button>
                  <button id="btnCerrar" class="btn btn-danger">Cerrar</button>
                </div>

                <div hidden id="panelAgregar" class="panel-body">
                    @section('mensajesBackEnd')
                      @parent
                    @endsection
                    <form id="form" class="form" method="POST" action="/sucursales/nuevo">
                     {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-8">

                          <div class="input-group">
                            <label class="sr-only" for="nombre">Sucursal</label>
                            <div class="input-group-addon">Sucursal</div>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre" required>
                          </div>

                        </div>
                      </div>

                      @include("partials.direcciones")
                      <br/>
                      
                      <br/>
                      <div class="text-center">
                        <button type="submit" id="guardar"  class="btn btn-primary">Agregar</button>
                        <button class="btn btn-warning" onclick="$('#form').trigger('reset');">Limpiar datos</button>
                      </div>
                    <!-- Modal -->
                    <div class="modal fade" id="modalExistencia" tabindex="-1" role="dialog" aria-labelledby="modalExistenciaLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="modalExistenciaLabel">Modal title</h5>
                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                              </button>
                            </div>
                            <div class="modal-body">
                            @foreach($sucursales as $sucursal)
                            <table class="table">
                              <thead>
                                <tr>
                                  <th>Id </th>
                                  <th>Sucursal</th>
                                  <th>Inventario inicial</th>
                                </tr>
                              </thead>
                              <tbody>
                              <td>{{$sucursal->id}}</td>
                              <td>{{$sucursal->nombre}}</td>
                              <td><input class="inventarioSucursal" value="0" min="0" data-idSucursal="{{$sucursal->id}}" type="number"></td>
                              </tbody>
                            </table>
                            @endforeach
                            </div>
                            <div class="modal-footer">
                              <input hidden type="text" name="dataInventarioInicial" id="dataInventarioInicial">
                              <input hidden type="text" name="idProducto" id="idProducto">
                              <button type="button" id="guardarInventario" class="btn btn-primary" data-dismiss="modal">Guardar cambios</button>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!-- Modal -->
                    </form>
                    <form hidden id="formDesactivar" class="form" method="POST" action="/productos/cambioEstatus" >
                      <input hidden type="text" name="idProducto" id="idProductoCambioStatus">
                      {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <!-- aqui va la informacion que se va a cargar a la tabla de entradas -->
            <div class="panel panel-default">
                <div class="panel-heading">
                  Productos
                   <a title="Carga masiva" class="btn btn-success"><i class="glyphicon glyphicon-cloud-upload"></i></a>
                </div>
               

                <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table" id="dataTable">
                        <thead>
                          <tr>
                            <th>Acciones</th>
                            <th>Nombre</th>
                            <th>Descripci&oacute;n</th>
                            <th>Clave producto servicio</th>
                            <th>Precio A</th>
                            <th>Precio B</th>
                            <th>Precio C</th>
                            <th>Codigo de barras</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                         
                        </tbody>
                      </table>
                    </div>
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