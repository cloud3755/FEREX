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
                  <span>Nuevo producto</span>
                  <button id="btnAgregar" class="btn btn-success">Agregar</button>
                  <button id="btnCerrar" class="btn btn-danger">Cerrar</button>
                </div>

                <div hidden id="panelAgregar" class="panel-body">
                    @section('mensajesBackEnd')
                      @parent
                    @endsection
                    <form id="form" class="form" method="POST" action="/productos/nuevo">
                     {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-6">

                          <div class="input-group">
                            <label class="sr-only" for="nombre">Producto</label>
                            <div class="input-group-addon">Producto</div>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre" required>
                          </div>

                        </div>
                        <div class="col-md-6">

                          <div class="input-group">
                            <label class="sr-only" for="descripcion">Descripción</label>
                            <div class="input-group-addon">Descripción</div>
                            <textarea rows="1" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion"></textarea>
                          </div>

                        </div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-8">

                          <div class="input-group">
                            <label class="sr-only" for="nombre">Url Imagen Producto</label>
                            <div class="input-group-addon">Url Imagen Producto</div>
                            <input type="text" class="form-control" name="urlImagen" id="urlImagen" placeholder="urlImagen">
                          </div>

                        </div>

                        <div class="col-md-4">
                          <div id="imgProducto">
                          <img src="" width="100" height="100">
                          </div>
                          

                        </div>
                        
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-4">

                          <div class="input-group">

                            <label class="sr-only" for="claveProdServ">Clave SAT</label>
                            <div class="input-group-addon">Clave SAT</div>
                            <input type="text" class="form-control" name="claveProdServ" id="claveProdServ" placeholder="clave SAT">

                          </div>

                        </div>
                        <div class="col-md-4">

                          <div class="input-group">
                            <label class="sr-only" for="minimoAlarma">Alarma <br/> de inventario</label>
                            <div class="input-group-addon">Alarma <br/> de inventario</div>
                            <input type="number" min = "1" class="form-control" name="minimoAlarma" id="minimoAlarma" placeholder="Alarma">
                          </div>

                        </div>
                        <div class="col-md-4">

                            <div class="input-group">
  
                              <label class="sr-only" for="codigoBarras">C&oacute;digo de barras</label>
                              <div class="input-group-addon">C&oacute;digo de barras</div>
                              <input type="text"  class="form-control" name="codigoBarras" id="codigoBarras" placeholder="Code">
  
                            </div>
  
                          </div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-3">

                          <div class="input-group">

                            <label class="sr-only" for="unidadMedida">Costo</label>
                            <div class="input-group-addon">Costo</div>
                            <input type="number" step="any"  class="form-control" name="Costo" id="Costo" placeholder="Costo">

                          </div>

                        </div>
                        <div class="col-md-3">

                          <div class="input-group">

                            <label class="sr-only" for="unidadMedida">Precio A</label>
                            <div class="input-group-addon">Precio A</div>
                            <input type="number" step="any"  class="form-control" name="precioA" id="precioA" placeholder="precio" required>

                          </div>
  
                        </div>
                        <div class="col-md-3">

                            <div class="input-group">
  
                              <label class="sr-only" for="unidadMedida">Precio B</label>
                              <div class="input-group-addon">Precio B</div>
                              <input type="number" step="any" class="form-control" name="precioB" id="precioB" placeholder="precio">
  
                            </div>
    
                          </div>
                          <div class="col-md-3">

                              <div class="input-group">
    
                                <label class="sr-only" for="unidadMedida">Precio C</label>
                                <div class="input-group-addon">Precio C</div>
                                <input type="number" step="any"  class="form-control" name="precioC" id="precioC" placeholder="precio">
    
                              </div>
      
                          </div>
                      </div>
                      <br/>
                      <div class="row text-center">
                        <button type="button" class="btn btn-default" id="setInventario" data-toggle="modal" data-target="#modalExistencia">Inventario inicial</button>
                      </div>
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
                   <a title="Carga masiva" data-toggle="modal" data-target="#modalCargaMasiva" class="btn btn-success"><i class="glyphicon glyphicon-cloud-upload"></i> Carga masiva</a>
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
                            @foreach($sucursales as $sucursal)
                              <th>{{$sucursal->nombre}}</th>
                            @endforeach
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


<div class="modal fade" id="modalCargaMasiva" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalExistenciaLabel">Carga masiva</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      Instrucciones:
      <form id="form" class="form" method="POST" action="/productos/cargaMasiva" enctype="multipart/form-data">
      {{ csrf_field() }}
      <ol>
        <li>Descargar el layout <a href="/productos/layout"  class="btn btn-primary">Aqui</a></li>
        <li>Llnenar las columnas correspondientes</li>
        <li>Las ultimas columnas pertenecen al inventario por sucursal, dependiendo del id
          de la sucursal, introduzca la cantidad de inventario inicial
        </li>
        <li>Suba el layout <input type="file" name="layout" id="layout" accept="xls">  </li>
        
        <li>De click en cargar</li>
        <li>Se cargaran los datos</li>
      </ol>
      <input type="submit" value="cargar">
      </form>
      <span class="text-danger">No utilice el mismo layout para cargas posteriores, descargue uno nuevo en este apartado</span>
     <!-- <table class="table">
        <thead>
          <tr>
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
      -->
      </div>
      <div class="modal-footer">
        <input hidden type="text" name="dataInventarioInicial" id="dataInventarioInicial">
        <input hidden type="text" name="idProducto" id="idProducto">
        <button type="button" id="guardarInventario" class="btn btn-primary" data-dismiss="modal">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>

<div class="modal fade" id="modalBarras" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body text-center">
      <div id="barcodeDiv">
        <svg id="barcode"></svg>
      </div>
      </div>
      <div class="modal-footer">
        <input hidden type="text" name="dataInventarioInicial" id="dataInventarioInicial">
        <input hidden type="text" name="idProducto" id="idProducto">
        <button type="button" id="imprimirCodigo" class="btn btn-primary" data-dismiss="modal">Imprimir</button>
      </div>
    </div>
  </div>
</div>



@endsection
  @section('scripts.personalizados')
  @parent
    <script src="{{ asset('js/productos/productosApp.js') }}"></script>
    <script src="{{ asset('js/utils/JsBarcode.all.min.js') }}"></script>
  @endsection