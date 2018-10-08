@extends('layouts.app')
@section('styles')
    @parent
    <link href="{{ asset('bootstrapUtils/css/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrapUtils/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrapUtils/css/bootstrap-select.css.map') }}" rel="stylesheet">
@endsection
@section('content')

<div class="container">

  <div class="panel panel-primary">
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
            @include("partials.direcciones")
            <br/>
            <div class="text-center">
              <button type="submit"  class="btn btn-info">Agregar</button>
              <button class="btn btn-warning" onclick="$('form').reset">Limpiar datos</button>
            </div>
          </form>

      </div>
  </div>

  <div class="panel panel-primary">
      <div class="panel-heading">Clientes</div>

      <div class="panel-body">
          <div class="table-responsive">
            <table class="table" id="tablaclientes">
              <thead>
                <tr>
                  <th>Numero de Cliente</th>
                  <th>Nombre</th>
                  <th>Razon Social</th>
                  <th>Rfc</th>
                  <th>Correo</th>
                  <th>Limite de credito</th>
                  <th>Telefonos</th>
                  <th>Consumo</th>
                  <th>Status</th>
                  <th>Calle</th>
                  <th>Num Interior</th>
                  <th>Num Exterior</th>
                  <th>Entre</th>
                  <th>Entre</th>
                  <th>Referencia</th>
                  <th>Colonia</th>
                  <th>CP</th>
                  <th>Ciudad</th>
                  <th>Estado</th>

                </tr>
              </thead>
              <tbody>
                @foreach ($clientes as $cliente)
                <tr>
                  <td>{{$cliente->id}}</td>
                  <td>{{$cliente->nombre}}</td>
                  <td>{{$cliente->razonSocial}}</td>
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
                  <td>{{$cliente->calle}}</td>
                  <td>{{$cliente->numInterior}}</td>
                  <td>{{$cliente->numExterior}}</td>
                  <td>{{$cliente->entre1}}</td>
                  <td>{{$cliente->entre2}}</td>
                  <td>{{$cliente->referencia}}</td>
                  <td>{{$cliente->colonia}}</td>
                  <td>{{$cliente->CP}}</td>
                  <td>{{$cliente->ciudad}}</td>
                  <td>{{$cliente->estado}}</td>
                </tr>
                  @endforeach
              </tbody>
            </table>
          </div>
      </div>
  </div>

</div>

<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document" style="width:80%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Edditar Cliente.</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form" method="POST" action="/AltaCliente/nuevo">
         {{ csrf_field() }}
          <div class="row">
            <div class="col-md-6">

              <div class="input-group">
                <label class="sr-only" for="nombre">Nombre</label>
                <div class="input-group-addon">Nombre</div>
                <input type="text" class="form-control" name="nombre" id="nombreEditar" placeholder="nombre" required>
              </div>

            </div>
            <div class="col-md-6">

              <div class="input-group">
                <label class="sr-only" for="descripcion">Razon social</label>
                <div class="input-group-addon">Razon social</div>
                <textarea rows="1" class="form-control" name="RazonSocial" id="razonEditar" placeholder="Razon Social"></textarea>
              </div>

            </div>
          </div>
          <br/>
          <div class="row">
            <div class="col-md-4">

              <div class="input-group">
                <label class="sr-only" for="minimoAlarma">RFC</label>
                <div class="input-group-addon">RFC </div>
                <input type="text" class="form-control" name="Rfc" id="rfcEditar" placeholder="RFC">
              </div>

            </div>
            <div class="col-md-4">

                <div class="input-group">

                  <label class="sr-only" for="codigoBarras">Correo</label>
                  <div class="input-group-addon">Correo</div>
                  <input type="text"  class="form-control" name="Correo" id="correoEditar" placeholder="Correo">

                </div>

              </div>
          </div>
          <br/>
          <div class="row">
            <div class="col-md-4">

              <div class="input-group">

                <label class="sr-only" for="unidadMedida">Limte de Credito</label>
                <div class="input-group-addon">Limite de Credito</div>
                <input type="number" min="0.01"  class="form-control" name="LimiteDeCredito" id="creditoEditar" placeholder="LimiteDeCredito">

              </div>

            </div>
            <div class="col-md-4">

                <div class="input-group">

                  <label class="sr-only" for="unidadMedida">Telefono 1</label>
                  <div class="input-group-addon">Telefono 1</div>
                  <input type="text"   class="form-control" name="Telefono1" id="telefono1Editar" placeholder="Telefono1">

                </div>

              </div>

          </div>

          <br>
          <div class="row">
            <div class="col-md-4">

              <div class="input-group">

                <label class="sr-only" for="unidadMedida">Telefono 2</label>
                <div class="input-group-addon">Telefono 2</div>
                <input type="text"  class="form-control" name="Telefono2" id="telefono2Editar" placeholder="Telefono 2">

              </div>

            </div>
            <div class="col-md-4">

                <div class="input-group">

                  <label class="sr-only" for="unidadMedida">Telefono 3</label>
                  <div class="input-group-addon">Telefono 3</div>
                  <input type="text"   class="form-control" name="Telefono3" id="telefono3Editar" placeholder="Telefono3">

                </div>

              </div>

          </div>

          <br/>
          <br>
          <div class="row">
            <div class="col-md-4">

              <div class="input-group">
                <label class="sr-only" for="numInterior">N&uacute;mero interior</label>
                <div class="input-group-addon">N&uacute;mero interior</div>
                <input type="text" class="form-control" name="numInterior" id="numInteriorEditar" placeholder="num interior">
              </div>

            </div>
            <div class="col-md-4">

              <div class="input-group">
                <label class="sr-only" for="numExterior">N&uacute;mero exterior</label>
                <div class="input-group-addon">N&uacute;mero exterior</div>
                <input type="text" class="form-control" name="numExterior" id="numExteriorEditar" placeholder="num exterior">
              </div>

            </div>
            <div class="col-md-4">

              <div class="input-group">
                <label class="sr-only" for="referencia">Referencia</label>
                <div class="input-group-addon">Referencia</div>
                <textarea rows="1" class="form-control" name="referencia" id="referenciaEditar" placeholder="referencia"></textarea>
              </div>

            </div>
          </div>
          <br><br>
          <div class="row">
            <div class="col-md-4">

              <div class="input-group">
                <label class="sr-only" for="calle">Calle</label>
                <div class="input-group-addon">Calle</div>
                <input type="text" class="form-control" name="calle" id="calleEditar" placeholder="Calle">
              </div>

            </div>
            <div class="col-md-4">

              <div class="input-group">
                <label class="sr-only" for="entre1">Entre</label>
                <div class="input-group-addon">Entre</div>
                <input type="text" class="form-control" name="entre1" id="entre1Editar" placeholder="entre">
              </div>

            </div>

            <div class="col-md-4">

              <div class="input-group">
                <label class="sr-only" for="entre2">Y Entre</label>
                <div class="input-group-addon">Y Entre</div>
                <input type="text" class="form-control" name="entre2" id="entre2Editar" placeholder="entre">
              </div>

            </div>
          </div>
          <br><br>
          <div class="row">
            <div class="col-md-4">

              <div class="input-group">
                <label class="sr-only" for="colonia">colonia</label>
                <div class="input-group-addon">Colonia</div>
                <input type="text" class="form-control" name="colonia" id="coloniaEditar" placeholder="colonia">
              </div>

            </div>
            <div class="col-md-4">

              <div class="input-group">
                <label class="sr-only" for="CP">CP</label>
                <div class="input-group-addon">CP</div>
                <input type="text" class="form-control" name="CP" id="CPeditar" placeholder="CP">
              </div>

            </div>

          </div>
          <br><br>
          <div class="row">


            <div class="col-md-4">

              <div class="input-group">
                <label class="sr-only" for="estado">Estado</label>
                <div class="input-group-addon">Estado</div>
                  <input type="text" class="form-control" name="estado" id="estadoEditar" placeholder="CP">
              </div>


            </div>


            <div class="col-md-4">

              <div class="input-group">
                <label class="sr-only" for="entre2">ciudad</label>
                <div class="input-group-addon">ciudad</div>
                  <input type="text" class="form-control" name="ciudad" id="ciudadEditar" placeholder="CP">
              </div>

            </div>
          </div>
          <br>
          <br/>
          <div class="text-center">
            <button type="submit"  class="btn btn-info">Agregar</button>
            <button class="btn btn-warning" onclick="$('form').reset">Limpiar datos</button>
          </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

<script language="JavaScript" type="text/javascript" src="/js/jquery-3.3.1.js"></script>

<script type="text/javascript">

      $(document).ready(function () {

        // se obtiene el registro al dar click

        $("#tablaclientes tbody tr").click(function() {
          var nombre = $(this).find("td:eq(1)").text();
          var razon = $(this).find("td:eq(2)").text();
          var rfc = $(this).find("td:eq(3)").text();
          var correo = $(this).find("td:eq(4)").text();
          var credito = $(this).find("td:eq(5)").text();
          var telefonos = $(this).find("td:eq(6)").text();
          var split = telefonos.split(',');
          var numInterior = $(this).find("td:eq(10)").text();
          var numExterior = $(this).find("td:eq(11)").text();
          var referencia = $(this).find("td:eq(14)").text();
          var calle = $(this).find("td:eq(9)").text();
          var entre1 = $(this).find("td:eq(12)").text();
          var entre2 = $(this).find("td:eq(13)").text();
          var colonia = $(this).find("td:eq(15)").text();
          var cp = $(this).find("td:eq(16)").text();
          var estado = $(this).find("td:eq(18)").text();
          var ciudad = $(this).find("td:eq(17)").text();


          $("#myModal").modal()

          // console.log(nombre);
           document.getElementById('nombreEditar').value=nombre;
           document.getElementById('razonEditar').value=razon;
           document.getElementById('rfcEditar').value=rfc;
           document.getElementById('correoEditar').value=correo;
           document.getElementById('creditoEditar').value=credito
           //se separan los teefonos con ,
           if(split[0]==undefined)
            document.getElementById('telefono1Editar').value="";
           else
           document.getElementById('telefono1Editar').value=split[0];
           if(split[1]==undefined)
              document.getElementById('telefono2Editar').value="";
           else
           document.getElementById('telefono2Editar').value=split[1];
           if(split[2]==undefined)
            document.getElementById('telefono3Editar').value="";
           else
           document.getElementById('telefono3Editar').value=split[2];

           document.getElementById('numInteriorEditar').value=numInterior;
           document.getElementById('numExteriorEditar').value=numExterior;
           document.getElementById('referenciaEditar').value=referencia;
           document.getElementById('calleEditar').value=calle;
           document.getElementById('entre2Editar').value=entre2;
           document.getElementById('entre1Editar').value=entre1;
           document.getElementById('coloniaEditar').value=colonia;
           document.getElementById('CPeditar').value=cp;
           document.getElementById('estadoEditar').value=estado;
           document.getElementById('ciudadEditar').value=ciudad;


        });
    });

</script>

@endsection
  @section('scripts.personalizados')
  @parent
    <script src="{{ asset('js/productos/productosApp.js') }}"></script>
    <script src="{{ asset('js/ciudades/ciudades.js') }}"></script>
  @endsection
