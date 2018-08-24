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
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($cajas as $caja)
                                <td>$caja->id</td>
                                <td>$caja->nombre</td>
                                <td>$caja->saldo</td>
                                <td>$caja->estado</td>
                                <td>$caja->sucursal</td>
                            @endforeach
                        </tbody>
                      </table>
                    <form hidden  id="form" method="POST" action="/inventario/manual" }}>
                       {{ csrf_field() }}
                      <input type="text" id="datosInventario" name="datosInventario" />
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
@section('scripts.personalizados')
@parent
<script src="{{ asset('js/utils/inputNumberUtil.js') }}"></script>
<script src="{{ asset('js/inventario/inventarioApp.js') }}"></script>
@endsection
