<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Ferex') }}</title>

    <!-- Styles -->

    @section('styles')

 <!--   <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">-->
 <!--   <link rel="stylesheet" href="{{ asset("assets/stylesheets/styles.css") }}" />-->


    <link href="{{ asset('bootstrap3/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('AwesomeFonts/css/all.css') }}" rel="stylesheet">
    <link href="{{ asset('css/personalizado.css') }}" rel="stylesheet">
    <link href="{{ asset('css/MenuVertical.css') }}" rel="stylesheet">


    @show
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-default navbar-static-top navbarPersonal">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'FEREX') }}
                    </a>
                </div>

                <div class="collapse navbar-collapse" id="app-navbar-collapse">
                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        @guest
                        @else
                         <li><a href="/productos">Productos</a></li>
                         <li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="#">Altas
                            <span class="caret"></span></a>
                            <ul class="dropdown-menu">
                              <li><a href="/AltaClientes">Alta de clientes</a></li>
                              <li><a href="/sucursales"> </i>Alta de sucursales</a></li>
                              <li><a href="/inventario/manual"> </i>Alta de inventario</a></li>
                            </ul>
                          </li>
                            <li><a href="/venta">Venta</a></li>
                            <li>
                              <a href="/Dashboard">
                                <i class="fas fa-tachometer-alt"></i> Dashboard
                              </a>
                            </li>
                         @endguest
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">Login</a></li>
                            <li><a href="{{ route('register') }}">Registro</a></li>
                        @else
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            Salir
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
  @guest
  @else
  <!-- <div class="nav-side-menu">
    <div class="brand">Ferex</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="/Dashboard">
                <i class="fas fa-tachometer-alt"></i> Dashboard
                  </a>
                </li>

                <li  data-toggle="collapse" data-target="#productsCollapse" >
                  <a href="#"><i class="glyphicon glyphicon-gift"></i> Productos<i class="fas fa-chevron-down"></i></a>
                </li>
                <ul class="sub-menu collapse" id="productsCollapse">
                    <li class="active"><a href="/productos"><i class="fa fa-plus"></i>Alta de productos</a></li>
                </ul>


                <li data-toggle="collapse" data-target="#serviceCollapse" class="collapsed">
                  <a href="#"><i class="glyphicon glyphicon-globe"></i> Altas <i class="fas fa-chevron-down"></i></a>
                </li>
                <ul class="sub-menu collapse" id="serviceCollapse">
                  <li><a href="/AltaClientes"> <i class="fas fa-plus"></i>Alta de clientes</a></li>
                  <li><a href="/sucursales"> <i class="fas fa-plus"></i>Alta de sucursales</a></li>

                  <li><i class="fas fa-plus"></i>Alta de usuarios</li>
                </ul>


                <li data-toggle="collapse" data-target="#new" class="collapsed">
                  <a href="#">Ventas <i class="fas fa-chevron-down"></i></a>
                </li>
                <ul class="sub-menu collapse" id="new">
                    <li><a href="/venta"> <i class="fas fa-plus"></i>Venta</a></li>
                </ul>

                  <li>
                  <a href="#">
                  <i class="fa fa-user fa-lg"></i> Profile
                  </a>
                  </li>

                 <li>
                  <a href="#">
                  <i class="fa fa-users fa-lg"></i> Users
                  </a>
                </li>
            </ul>
     </div>
</div> -->
@endguest
        @section('mensajesBackEnd')
            @if(Session::has('Guardado'))
                <div class="alert alert-success"><span></span><em> {!! session('Guardado') !!}</em></div>
            @endif
            @if(Session::has('Warning'))
                <div class="alert alert-warning"><span></span><em> {!! session('Warning') !!}</em></div>
            @endif
        @show
        @yield('content')
    </div>

  @section('scripts.basic')
    <script src="{{ asset('bootstrapUtils/js/popper.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('bootstrap3/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>

    <!--  <script src="{{ asset('js/app.js') }}"></script>-->
    <!--  <script src="{{ asset('bootstrap3/js/bootstrap.js') }}"></script>-->

    @show

    @section('scripts.DataTable')

        <script src="{{ asset('bootstrapUtils/js/datatables.js') }}"></script>
        <script src="{{ asset('js/utils/datatable.js') }}"></script>
    @show

    @section('scripts.Select')
    <!--Script select 2 -->
        <script src="{{ asset('bootstrapUtils/js/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('bootstrapUtils/js/bootstrap-select.js') }}"></script>

    @show

    @section('scripts.personalizados')

    @show
</body>
</html>
