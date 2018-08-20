@extends('layouts.app')
@section('styles')
    @parent
    <link href="{{ asset('bootstrapUtils/css/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrapUtils/css/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('bootstrapUtils/css/bootstrap-select.css.map') }}" rel="stylesheet">
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Capturar Inventario manual</div>

                <div class="panel-body">
                
                    @section('mensajesBackEnd')
                    @parent
                    @endsection
                    <form class="form" >
                      <div class="row">
                        <div class="col-xs-4">

                          <div class="input-group">

                            <label class="sr-only" for="GIN">Producto</label>
                            <div class="input-group-addon">Producto</div>
                            <select class="form-control selectpicker producto"   id="Productos" name="Productos" data-live-search="true" data-width="100%" required>
                                @foreach($productos as $producto)
                                    <option   data-id="{{$producto->id}}"  data-descripcion="{{$producto->descripcion}}"  data-existencia="{{$producto->cantidad}}"  value="{{$producto->precioA}}"  data-codigo="{{$producto->codigoBarras}}">{{$producto->codigoBarras}} - {{$producto->descripcion}}</option>
                                @endforeach
                            </select>
                          </div>

                        </div>
                        <div class="col-xs-3">

                          <div class="input-group">
                            <label class="sr-only" for="lote">Cantidad</label>
                            <div class="input-group-addon">Cantidad</div>
                            <input type="text" class="form-control" id="lote" placeholder="Lote">
                          </div>

                        </div>

                        <div class="col-xs-5">
                          <div class="input-group">
                            <label class="sr-only" for="ubicacion">Sucursal</label>
                            <div class="input-group-addon">Sucursal</div>
                            <select class="form-control selectpicker" id="ubicacionsel" data-live-search="true" data-width="100%" name="ubicacion">
                              @foreach ($sucursales as $sucursal)
                              <option data-id="{{$sucursal->id}}" value="{{$sucursal->nombre}}">{{$sucursal->nombre}}</option>
                              @endforeach
                            </select>
                          </div>
                        </div>

                      </div>
                      <br>
                      <div class="text-center">
                        <button type="button" id="agregarInventario" class="btn btn-primary">Agregar</button>
                        <button class="btn btn-danger">Limpiar datos</button>
                      </div>

                    </form>

                </div>
            </div>
            <!-- aqui va la informacion que se va a cargar a la tabla de entradas -->
            <div class="panel panel-default">
                <div class="panel-heading">Entradas</div>

                <div class="panel-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif -->
                    <div class="table-responsive">
                      <table class="table" id="tableEntrada">
                        <thead>
                          <tr>
                            <th>Producto</th>
                            <th>DESCRIPCION</th>
                            <th>CANTIDAD</th>
                            <th>Sucursal</th>
                            <th>Quitar</th>
                          </tr>
                        </thead>
                        <tbody>

                        </tbody>
                      </table>
                    <form hidden  id="form" method="POST" action="/entradas" }}>
                       {{ csrf_field() }}
                      <input type="text" id="datosEntrada" name="datosEntrada" />
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- <form class="" action="/subirarchivo" method="post" accept-charset="UTF-8" enctype="multipart/form-data">
  <input type="hidden" name="_token" value="{{ csrf_token() }}">
  <div class="form-group form-group-lg">
  <h2><label for="Usuario" class="control-label col-md-12">(*) Archivo:</label></h2>
  <div class="col-md-6 col-sm-9">
    <input class="form-control input-lg" id="archivo" type="file" placeholder="Elige el archivo" name="archivo" required>
  </div>
</div>

<div class="modal-footer">
<button type="submit" class="btnobjetivo" id="btnobjetivo" style="font-family: Arial;">Subir Documento</button>
    <button type="button" class="btn btn-default" data-dismiss="modal" id="btnCloseUpload">Cerrar</button>
</div>

</form> -->




@endsection
@section('scripts')
@parent
<script src="{{ asset('js/utils/date.js') }}"></script>
<script src="{{ asset('js/utils/inputNumberUtil.js') }}"></script>
<script src="{{ asset('js/entradas/appEntradas.js') }}"></script>
@endsection
