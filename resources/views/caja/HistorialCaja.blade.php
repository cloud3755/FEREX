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
                    

                      <table class="table" id="dataTable">
                        <thead>
                          <tr>
                            <th>Sucursal</th>
                            <th>Caja</th>
                            <th>Tipo</th>
                            <th>Saldo del sistema</th>
                            <th>Saldo real</th>
                            <th>Diferencia</th>
                            <th>Fecha</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($historialCaja as $historial)
                                <tr>
                                    <td>{{$historial->nombreSucursal}}</td>
                                    <td>{{$historial->nombreCaja}}</td>
                                    <td>
                                        {{$historial->tipoNombre}}
                                        @if($historial->tipoNombre=="Corte")
                                            <a class="btn btn-default" target="_blank"  href="/cajas/imprimir/{{$historial->idCorte}}/pdf">Imprimir pdf</a>
                                        @endif
                                    </td>
                                    <td>{{$historial->saldoSistema}}</td>
                                    <td>{{$historial->saldoCapturado}}</td>
                                    <td>{{$historial->diferencia}}</td>
                                    <td>{{$historial->fechaHora}}</td>
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
