@extends('layouts.app')
@section('styles')
    @parent
@endsection
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-default">
                <div class="panel-heading">Cajas Historial</div>

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
                            <th>Sucursal</th>
                            <th>Caja</th>
                            <th>Tipo</th>
                            <th>Diferencia</th>
                            <th>Fecha</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($cajas as $caja)
                                <td>{{$caja->id}}</td>
                                <td>{{$caja->nombre}}</td>
                                <td>{{$caja->estadoNombre}}</td>
                                <td><input id="saldo" type="number" value="{{$caja->saldo}}" ></td>
                                <td>{{$caja->sucursal}}</td>
                                @switch($caja->estado)
                                    @case("NI")
                                        <td><button type="button" data-id-caja="{{$caja->id}}" id="Iniciar" data-id-operacion="I" class="btn btn-success  InicioCaja" >Iniciar</button></td>
                                    @break
                                    @case("I")
                                        <td><button type="button" data-saldo="{{$caja->saldo}}" data-sucursal="{{$caja->sucursal}}" data-caja="{{$caja->nombre}}" data-id-caja="{{$caja->id}}" id="Corte" data-operacion="Corte" data-id-operacion="C" class="btn btn-danger  corteArqueo">Corte</button></td>
                                        <td><button type="button" data-saldo="{{$caja->saldo}}" data-sucursal="{{$caja->sucursal}}" data-caja="{{$caja->nombre}}" data-id-caja="{{$caja->id}}" id="Arqueo" data-operacion="Arqueo" data-id-operacion="A" class="btn btn-warning  corteArqueo">Arqueo</button></td>
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
        <div class="modal-title" id="modalCajaLabel"></div>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="modalBodyCambioCaja">
      <form>
      Saldo actual en sistema <span id="saldoActualLabel"></span><br>
      Saldo real en la caja   <input type="number" id="saldoReal" required>
      </div>
      <div class="modal-footer">
        <button type="button" id="operacionCaja" class="btn btn-primary" data-dismiss="modal">Guardar cambios</button>
      </div>
      </form>
    </div>
  </div>
</div>



@endsection
@section('scripts.personalizados')
@parent
<script src="{{ asset('js/cajas/cajasApp.js') }}"></script>
@endsection
