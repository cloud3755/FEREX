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
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Capturar Venta</div>

                    <div class="panel-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                                </div>
@endif -->
                        @section('mensajesBackEnd')
                            @parent
                        @endsection
                        <form class="form" >
                            <div class="row">
                                <button  id="nuevoCliente" class="btn btn-secondary"> Nuevo cliente</button>
                                <br>
                                <br>

                                <div class="col-xs-4">

                                    <div class="input-group">

                                        <label class="sr-only" for="Clientes">Cliente</label>
                                        <div class="input-group-addon">Cliente</div>

                                            <select class="form-control selectpicker cliente"   id="Cliente" name="Cliente" data-live-search="true" data-width="100%" required>
                                                <option value="0"     data-limiteCredito="0"  data-creditoActual="0" data-descripcion="Cliente general" selected>Cliente general</option>
                                            @foreach($clientes as $cliente)
                                                <option  data-limiteCredito="{{$cliente->limiteCredito}}"  data-creditoActual="{{$cliente->credito}}" data-id="{{$cliente->id}}" data-descripcion="{{$cliente->rfc}}" value="{{$cliente->rfc}}">{{$cliente->email}} - {{$cliente->rfc}}</option>
                                            @endforeach
                                        </select> <button id="fijarCliente" class="btn btn-secondary">Fijar cliente</button>
                                    </div>
                                </div>

                                <br><br><br><br><br>
                                <div class="col-xs-4">

                                    <div id="productosDiv" class="input-group">
                                        <label class="sr-only" for="Productos">Productos</label>
                                        <div class="input-group-addon">Productos</div>
                                        <select class="form-control selectpicker producto"   id="Productos" name="Productos" data-live-search="true" data-width="100%" required>
                                            @foreach($productos as $producto)
                                                <option    data-preciob="{{$producto->precioB}}"   data-precioc="{{$producto->precioC}}"  data-id="{{$producto->id}}"  data-descripcion="{{$producto->descripcion}}"  data-existencia="{{$producto->cantidad}}"  value="{{$producto->precioA}}"  data-codigo="{{$producto->codigoBarras}}">{{$producto->codigoBarras}} - {{$producto->descripcion}}</option>
                                            @endforeach
                                        </select>
                                        <button id="precioB" class="btn btn-secondary">Precio B</button>
                                        <button id="precioC" class="btn btn-secondary">Precio C</button>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <input type="number" min="0.01"  value="0" class="form-control" name="credito" id="credito" placeholder="Vender a credito">Vender a credito
                                            <input  type="hidden" value="1"  class="form-control overCero" id="cantidad" placeholder="Cantidad">
                                        </div>
                                    </div>


                                </div>


                            </div>
                            <br>
                            <br>
                            <br>
                            <div class="text-center">
                                <button type="button" id="agregarEntrada" class="btn btn-primary">Agregar</button>

                            </div>
                        </form>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">Ventas Registradas</div>

                    <div class="panel-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                                </div>
@endif -->
                        <div class="table-responsive">
                            <button id="Procesar" type="button">Vender</button>

                            <table class="table" id="tableEntrada">
                                <thead>
                                <tr>

                                    <th>CLIENTE</th>
                                    <th>CODIGO DE BARRAS</th>
                                    <th>DESCRIPCION</th>
                                    <th>CANTIDAD</th>
                                    <th>PRECIO</th>
                                    <th>SUBTOTAL</th>
                                    <th>Quitar</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                            </table>

                            <div class="table" id="total">
                               Total
                                <label></label>
                            </div>
                            <form hidden  id="form" method="POST" action="/venta" }}>
                                {{ csrf_field() }}
                                <input type="text" id="vendedor" name="vendedor" value="0" />
                                <input type="text" id="cliente" name="cliente[]"  />
                                <input type="text" id="credito" name="credito[]"  />
                                <input type="text" id="idProdcuto" name="idProdcuto[]"  />
                                <input type="text" id="existencias" name="existencias[]"  />
                                <input type="text" id="producto" name="producto[]"  />
                                <input type="text" id="cantidad" name="cantidad[]"  />
                                <input type="text" id="precioProducto" name="precioProducto[]"  />
                                <input type="text" id="subTotal" name="subTotal[]"  />
                                <input type="text" id="total" name="total[]"  />
                                <input type="text" id="folio" name="folio[]"  />
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts.personalizados')
    @parent

    <script src="{{ asset('js/ventas/ventas.js') }}"></script>
@endsection
