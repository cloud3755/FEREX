@extends('layouts.app')
@section('styles')
    @parent
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">Cajas</div>

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
                            <th>Id</th>
                            <th>Caja</th>
                            <th>Estado</th>
                            <th>Saldo</th>
                            <th>Sucursal</th>
                            <th>Operacion</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($cajas as $caja)
                                <td>{{$caja->id}}</td>
                                <td>{{$caja->nombre}}</td>
                                <td>{{$caja->estadoNombre}}</td>
                                <td><input id="saldo" type="number" value="$caja->saldo" ></td>
                                <td>{{$caja->sucursal}}</td>
                                @switch($caja->estado)
                                    @case("NI")
                                        <td><button type="button" data-id-caja="{{$caja->id}}" id="Iniciar" data-id-operacion="I" class="btn btn-success  cambioStatus" >Iniciar</button></td>
                                    @break
                                    @case("I")
                                        <td><button type="button" data-id-caja="{{$caja->id}}" id="Corte" id-operacion="Reiniciar" class="btn btn-danger  cambioStatus">Corte</button></td>
                                        <td><button type="button" data-id-caja="{{$caja->id}}" id="Arqueo" id-operacion="Reiniciar" class="btn btn-warning  cambioStatus">Arqueo</button></td>
                                    @break
                                @endswitch
                            @endforeach
                        </tbody>
                      </table>
                    <form hidden  id="form" method="POST" action="/cajas/cambioStatus" }}>
                       {{ csrf_field() }}
                      <input type="text" id="datosCaja" name="datosCaja" />
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalCambioCaja" tabindex="-1" role="dialog"  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalExistenciaLabel">Caja</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalBodyCambioCaja">

      </div>
      <div class="modal-footer">
        <input hidden type="text" name="dataInventarioInicial" id="dataInventarioInicial">
        <input hidden type="text" name="idProducto" id="idProducto">
        <button type="button" id="guardarInventario" class="btn btn-primary" data-dismiss="modal">Guardar cambios</button>
      </div>
    </div>
  </div>
</div>



@endsection
@section('scripts.personalizados')
@parent
<script src="{{ asset('js/cajas/cajasApp.js') }}"></script>
@endsection
