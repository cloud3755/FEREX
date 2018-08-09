@extends('layouts.app')
@section('styles')
  @parent
@endsection
@section('content')

<div class="container">

  <div class="panel panel-default">
      <div class="panel-heading">
        <span>Nuevo cliente</span>
        <button id="btnAgregar" class="btn btn-success">Agregar</button>
        <button id="btnCerrar" class="btn btn-danger">Cerrar</button>
      </div>

      <div hidden id="panelAgregar" class="panel-body">
          @section('mensajesBackEnd')
            @parent
          @endsection
          <form class="form" method="POST" action="/AltaCliente/nuevo">
           {{ csrf_field() }}
            <div class="row">
              <div class="col-md-6">

                <div class="input-group">
                  <label class="sr-only" for="nombre">Nombre</label>
                  <div class="input-group-addon">Nombre</div>
                  <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre" required>
                </div>

              </div>
              <div class="col-md-6">

                <div class="input-group">
                  <label class="sr-only" for="descripcion">Razon social</label>
                  <div class="input-group-addon">Razon social</div>
                  <textarea rows="1" class="form-control" name="RazonSocial" id="descripcion" placeholder="Razon Social"></textarea>
                </div>

              </div>
            </div>
            <br/>
            <div class="row">
              <div class="col-md-4">

                <div class="input-group">

                  <label class="sr-only" for="claveProdServ">Contacto</label>
                  <div class="input-group-addon">Contacto</div>
                  <input type="text" class="form-control" name="Contacto" id="claveProdServ" placeholder="Contacto">

                </div>

              </div>
              <div class="col-md-4">

                <div class="input-group">
                  <label class="sr-only" for="minimoAlarma">RFC</label>
                  <div class="input-group-addon">RFC </div>
                  <input type="text" class="form-control" name="Rfc" id="minimoAlarma" placeholder="RFC">
                </div>

              </div>
              <div class="col-md-4">

                  <div class="input-group">

                    <label class="sr-only" for="codigoBarras">Correo</label>
                    <div class="input-group-addon">Correo</div>
                    <input type="text"  class="form-control" name="Correo" id="codigoBarras" placeholder="Correo">

                  </div>

                </div>
            </div>
            <br/>
            <div class="row">
              <div class="col-md-4">

                <div class="input-group">

                  <label class="sr-only" for="unidadMedida">Limte de Credito</label>
                  <div class="input-group-addon">Limite de Credito</div>
                  <input type="number" min="0.01"  class="form-control" name="LimiteDeCredito" id="precioA" placeholder="LimiteDeCredito">

                </div>

              </div>
              <div class="col-md-4">

                  <div class="input-group">

                    <label class="sr-only" for="unidadMedida">Telefono 1</label>
                    <div class="input-group-addon">Telefono 1</div>
                    <input type="text"   class="form-control" name="Telefono1" id="precioB" placeholder="Telefono1">

                  </div>

                </div>
                <div class="col-md-4">

                    <div class="input-group">

                      <label class="sr-only" for="unidadMedida">Direccion</label>
                      <div class="input-group-addon">Direccion</div>
                      <input type="text"  class="form-control" name="precioC" id="precioC" placeholder="Direccion">

                    </div>

                </div>
            </div>
            <br>
            <div class="row">
              <div class="col-md-4">

                <div class="input-group">

                  <label class="sr-only" for="unidadMedida">Telefono 2</label>
                  <div class="input-group-addon">Telefono 2</div>
                  <input type="text"  class="form-control" name="Telefono2" id="precioA" placeholder="Telefono 3">

                </div>

              </div>
              <div class="col-md-4">

                  <div class="input-group">

                    <label class="sr-only" for="unidadMedida">Telefono 3</label>
                    <div class="input-group-addon">Telefono 3</div>
                    <input type="text"   class="form-control" name="Telefono3" id="precioB" placeholder="Telefono3">

                  </div>

                </div>
            </div>

            <br/>
            <br/>
            <div class="text-center">
              <button type="submit"  class="btn btn-info">Agregar</button>
              <button class="btn btn-warning" onclick="$('form').reset">Limpiar datos</button>
            </div>
          </form>

      </div>
  </div>

  <div class="panel panel-default">
      <div class="panel-heading">Clientes</div>

      <div class="panel-body">
          <div class="table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>Numero de Cliente</th>
                  <th>Nombre</th>
                  <th>Razon Social</th>
                  <th>Contacto</th>
                  <th>Rfc</th>
                  <th>Correo</th>
                  <th>Limite de credito</th>
                  <th>Telefonos</th>
                  <th>Consumo</th>
                  <th>Status</th>
                  <th>Direccion</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($clientes as $cliente)
                <tr>
                  <td>{{$cliente->id}}</td>
                  <td>{{$cliente->nombre}}</td>
                  <td>{{$cliente->razonSocial}}</td>
                  <td>{{$cliente->contacto}}</td>
                  <td>{{$cliente->rfc}}</td>
                  <td>{{$cliente->email}}</td>
                  <td>{{$cliente->limiteCredito}}</td>
                  <td>{{$cliente->telefono1}}</td>
                  <td>{{$cliente->consumoTotal}}</td>

                  @if($cliente->activo==1)
                  <td>Activo</td>
                  @else
                  <td>Inactivo</td>
                  @endif

                </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
      </div>
  </div>

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
  </div>

</div>


@endsection
  @section('scripts.personalizados')
  @parent
    <script src="{{ asset('js/productos/productosApp.js') }}"></script>
  @endsection
