@extends('layouts.app')
@section('styles')
    @parent
@endsection
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-3">

                          <div class="input-group">

                            <label class="sr-only" for="GIN">Folio</label>
                            <div class="input-group-addon">Folio</div>
                            <input disabled type="text" value="{{$folio}}" /> 
                          </div>

                        </div>
                        
                        <div class="col-md-3">

                          <div class="input-group">
                            <div class="input-group-addon">Vendedor</div>
                            <input disabled type="text" value="{{$vendedor}}" /> 
                          </div>

                        </div>

                        <div class="col-md-3">

                          <div class="input-group">

                            <label class="sr-only" for="GIN">cliente</label>
                            <div class="input-group-addon">cliente</div>
                            <input disabled type="text" value="{{$cliente}}" /> 
                          </div>

                        </div>

                        <div class="col-md-3">

                          <div class="input-group">

                            <label class="sr-only" for="GIN">Forma de pago</label>
                            <div class="input-group-addon">Forma de pago</div>
                            <input disabled type="text" value="{{$formaDePago}}" /> 
                          </div>

                        </div>

                        

                    </div>
                </div>
            </div>  

                <div class="panel panel-default">
                    <div class="panel-heading">Ventas Historial Detalle</div>

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
                                    <th>Producto</th>
                                    <th>Cantidad</th>
                                    <th>Precio</th>
                                    <th>Total Linea</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($historial as $historia)
                                    <tr>
                                        <td>{{$historia->Producto}}</td>
                                        <td>{{$historia->cantidad}}</td>
                                        <td>{{$historia->precio}}</td>
                                        <td>{{$historia->totalLinea}}</td>
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
