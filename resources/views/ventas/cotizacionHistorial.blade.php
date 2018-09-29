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
                    <div class="panel-heading">Cotizacion Historial</div>

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

                                    <th>folio</th>
                                    <th>Vendedor</th>
                                    <th>Cliente</th>
                                    <th>Forma de pago</th>
                                    <th>Total</th>
                                    <th>fecha</th>
                                    <th>Detalle</th>
                                    <th>Vender</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($historial as $historia)
                                    <tr id="detalle">
                                        <td id="folio" name="folio">{{$historia->folio}}</td>
                                        <td>{{$historia->name}}</td>
                                        <td>{{$historia->nombre}}</td>
                                        <td>{{$historia->formaDePago}}</td>
                                        <td>{{$historia->Total}}</td>
                                        <td>{{$historia->created_at}}</td>
                                        <td><a id="folios" target="_blank" href="{{route('cotizacionHistorialDetalle', ['folio' => $historia->folio])}}">Detalle</a></td>
                                        <td><button type="button" id="vender" class="btn btn-success" data-toggle="modal" data-target="#modalVenta">
                                                Vender
                                            </button>

                                           </td>
                                    </tr>
                                    <!-- Modal -->
                                    <div class="modal fade" id="modalVenta" tabindex="-1" role="dialog" aria-labelledby="modalVenta" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <form  id="formCoti" method="POST" action="/cotizacionActualizar" }}>
                                                        {{ csrf_field() }}
                                                    <input  type="hidden" id="folioModal" name="folio"  />
                                                    <input  type="hidden" id="formaPagoModal" name="formaPago"  />
                                                    <select class="form-control selectpicker formaPago"   id="formaPago" name="formaPago" data-live-search="true" data-width="100%" required>


                                                        <option    value="efectivo"  >Efectivo</option>
                                                        <option    value="tarjetaCredito"  >Tarjeta de Credito</option>
                                                        <option    value="tarjetaDebito"  >Tarjeta de Debito</option>
                                                        <option    value="Transeferencia"  >Transeferencia</option>
                                                        <option    value="cheque"  >Cheque</option>
                                                    </select>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                    <button type="button" id="guardarCotizacion" class="btn btn-primary">Vender</button>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
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
    <script src="{{ asset('js/ventas/cotizacion.js') }}"></script>
    <script>
        thedataTables();
    </script>
@endsection
