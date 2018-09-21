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
        <div class="col-md-12 col-sm-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                  <span>Nueva Sucursal</span>
                  <button id="btnAgregar" class="btn btn-success">Agregar</button>
                  <button id="btnCerrar" class="btn btn-danger">Cerrar</button>
                </div>

                <div hidden id="panelAgregar" class="panel-body">
                    @section('mensajesBackEnd')
                      @parent
                    @endsection
                    <form id="form" class="form" method="POST" action="/sucursales/nuevo">
                     {{ csrf_field() }}
                      <div class="row">
                        <div class="col-md-8">

                          <div class="input-group">
                            <label class="sr-only" for="nombre">Sucursal</label>
                            <div class="input-group-addon">Sucursal</div>
                            <input type="text" class="form-control" name="nombre" id="nombre" placeholder="nombre" required>
                          </div>

                        </div>
                      </div>

                      @include("partials.direcciones")
                      <br/>
                      
                      <br/>
                      <div class="text-center">
                        <button type="submit" id="guardar"  class="btn btn-primary">Agregar</button>
                        <input hidden type="text" name="idSucursal" id="idSucursal">
                        <input hidden type="text" name="idDireccion" id="idDireccion">
                        <button class="btn btn-warning" onclick="$('#form').trigger('reset');">Limpiar datos</button>
                      </div>                  
                    </form>
                    <form hidden id="formDesactivar" class="form" method="POST" action="/productos/cambioEstatus" >
                      <input hidden type="text" name="idSucursal" id="idProductoCambioStatus">
                      {{ csrf_field() }}
                    </form>
                </div>
            </div>
            <!-- aqui va la informacion que se va a cargar a la tabla de entradas -->
            <div class="panel panel-default">
                <div class="panel-heading">
                  sucursales
                </div>
               

                <div class="panel-body">
                    <div class="table-responsive">
                      <table class="table" id="dataTable">
                        <thead>
                          <tr>
                            <th>Acciones</th>
                            <th>id</th>
                            <th>nombre</th>
                           
                            
                          </tr>
                        </thead>
                        <tbody>
                         
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
    <script src="{{ asset('js/sucursales/SucursalesApp.js') }}"></script>
    <script src="{{ asset('js/ciudades/ciudades.js') }}"></script>
  @endsection