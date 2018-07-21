@extends('layouts.app')
@section('styles')
@parent
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Nuevo producto</div>

                <div class="panel-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif -->
                    @section('mensajesBackEnd')
                    @parent
                    @endsection
                    <form class="form" method="POST" action="/productos/nuevo">
                     {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-6">

                          <div class="input-group">

                            <label class="sr-only" for="GIN">Nombre</label>
                            <div class="input-group-addon">Nombre</div>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre" required>
                          </div>

                        </div>
                        <div class="col-md-6">

                          <div class="input-group">
                            <label class="sr-only" for="lote">Descripción</label>
                            <div class="input-group-addon">Descripción</div>
                            <textarea rows="1" class="form-control" name="descripcion" id="descripcion" placeholder="Descripcion"></textarea>
                          </div>

                        </div>
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-6">

                          <div class="input-group">

                            <label class="sr-only" for="unidadMedida">Clave SAT</label>
                            <div class="input-group-addon">Clave SAT</div>
                            <input type="text" class="form-control" name="claveProdServ" id="claveProdServ" placeholder="clave SAT">

                          </div>

                        </div>
                        <div class="col-md-6">

                          <div class="input-group">
                            <label class="sr-only" for="unidadMedida">Alarma <br/> de inventario</label>
                            <div class="input-group-addon">Alarma <br/> de inventario</div>
                            <input type="number" min = "1" class="form-control" name="minimoAlarma" id="minimoAlarma" placeholder="clave SAT">
                          </div>

                        </div>
                        
                      </div>
                      <br/>
                      <div class="row">
                        <div class="col-md-6">

                          <div class="input-group">

                            <label class="sr-only" for="unidadMedida">C&oacute;digo de barras</label>
                            <div class="input-group-addon">C&oacute;digo de barras</div>
                            <input type="text"  class="form-control" name="codigoBarras" id="codigoBarras" placeholder="Code">

                          </div>

                        </div>
                        <div class="col-md-6">

                          <div class="input-group">

                            <label class="sr-only" for="unidadMedida">Precio</label>
                            <div class="input-group-addon">Precio</div>
                            <input type="number" min="0.01"  class="form-control" name="precio" id="precio" placeholder="precio">

                          </div>

                        </div>
                      </div>
                      <br/>
                      <div class="text-center">
                        <button type="submit"  class="btn btn-primary">Agregar</button>
                        <button class="btn btn-danger" onclick="$('form').reset">Limpiar datos</button>
                      </div>
                   
                    </form>

                </div>
            </div>
            <!-- aqui va la informacion que se va a cargar a la tabla de entradas -->
            <div class="panel panel-default">
                <div class="panel-heading">Productos</div>

                <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table" id="dataTable">
                        <thead>
                          <tr>
                            <th>Nombre</th>
                            <th>Descripci&oacute;n</th>
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
