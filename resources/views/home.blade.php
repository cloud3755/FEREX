@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Productos con existencia minima</div>

                <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table" id="dataTable">
                        <thead>
                          <tr>
                            <th>Nombre</th>
                            <th>Descripci&oacute;n</th>
                            <th>en stock</th>
                            <th>alarma</th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach($productos as $producto)
                          <tr>
                          <td>{{$producto->nombre}}</td>
                          <td>{{$producto->descripcion}}</td>
                          <td>{{$producto->stock}}</td>
                          <td>{{$producto->alarma}}</td>
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


