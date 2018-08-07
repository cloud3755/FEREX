@extends('layouts.app')
@section('scripts.basic')
    @parent
    <link href="{{ asset('css/bootstrap/bootstrap-select.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/bootstrap-select.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap/bootstrap-select.css.map') }}" rel="stylesheet">
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

                                <div class="col-xs-4">

                                    <div class="input-group">
                                        <label class="sr-only" for="Clientes">Cliente</label>
                                        <div class="input-group-addon">Cliente</div>
                                        <select class="form-control selectpicker" multiple  id="Cliente" name="Cliente" data-live-search="true" data-width="100%" required>
                                            @foreach($clientes as $cliente)
                                                <option data-descripcion="{{$cliente->rfc}}" value="{{$cliente->rfc}}">{{$cliente->email}} - {{$cliente->rfc}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                                <div class="col-xs-4">

                                    <div class="input-group">
                                        <label class="sr-only" for="Productos">Productos</label>
                                        <div class="input-group-addon">Productos</div>
                                        <select class="form-control selectpicker" multiple  id="Productos" name="Productos" data-live-search="true" data-width="100%" required>
                                            @foreach($productos as $producto)
                                                <option data-descripcion="{{$producto->descripcion}}" value="{{$producto->precioA}}"  data-codigo="{{$producto->codigoBarras}}">{{$producto->codigoBarras}} - {{$producto->descripcion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <br><br>
                                <div class="row">
                                    <div class="col-xs-4">
                                        <div class="input-group">
                                            <label class="sr-only" for="cantidad">Cantidad</label>
                                            <div class="input-group-addon">Cantidad</div>
                                            <input type="number" min="0" class="form-control overCero" id="cantidad" placeholder="Cantidad">
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
                            <form hidden  id="form" method="POST" action="/entradas" }}>
                                {{ csrf_field() }}
                                <input type="text" id="datosEntrada" name="datosEntrada" />
                                <input type="number" id="id_sucursal" name="id_sucursal" />
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
