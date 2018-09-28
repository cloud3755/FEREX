@extends('layouts.app')
@section('styles')
    @parent
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading">Ventas Historial</div>

                    <div class="panel-body">
                    <!-- @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                                </div>
@endif -->
                        <div class="table-responsive">


                            <table class="table" id="dataTable">
                                <thead>
                                <tr>
                                    <th>idVenta</th>
                                    <th>folio</th>
                                    <th>Vendedor</th>
                                    <th>Cliente</th>
                                    <th>Forma de pago</th>
                                    <th>Total</th>
                                    <th>fecha</th>
                                    <th>Re imprimir ticket</th>
                                    <th>Re imprimir pdf</th>
                                    <th>Detalle</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($historial as $historia)
                                    <tr>
                                        <td>{{$historia->id}}</td>
                                        <td>{{$historia->folio}}</td>
                                        <td>{{$historia->name}}</td>
                                        <td>{{$historia->nombre}}</td>
                                        <td>{{$historia->formaDePago}}</td>
                                        <td>{{$historia->Total}}</td>

                                        <td>{{$historia->created_at}}</td>

                                        <td> {{$historia->created_at}}</td>
                                        <td>{{$historia->created_at}}</td>
                                        <td><a href="{{route('ventaHistorialDetalle', ['idVenta' => $historia->id])}}">Detalle</a></td>
                                    </tr>
                                @endforeach
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
    <script>
        thedataTables();
    </script>
@endsection
