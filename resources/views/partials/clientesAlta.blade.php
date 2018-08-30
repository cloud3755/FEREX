<div class="modal fade bd-example-modal-lg" id="altaCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" >
  <div class="modal-dialog" role="document" style="width:70%;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Alta de clientes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" >
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
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>
