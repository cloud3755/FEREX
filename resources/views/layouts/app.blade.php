<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <!--<link href="{{ asset('css/bootstrap3.css') }}" rel="stylesheet">-->
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{ asset('css/personalizado.css') }}" rel="stylesheet">
    <link href="{{ asset('css/MenuVertical.css') }}" rel="stylesheet">
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
                        {{ config('app.name', 'Laravel') }}
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
                            </ul>
                          </li>
                            <li><a href="/venta">Venta</a></li>
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
  <div class="nav-side-menu">
    <div class="brand">Ferex</div>
    <i class="fa fa-bars fa-2x toggle-btn" data-toggle="collapse" data-target="#menu-content"></i>

        <div class="menu-list">

            <ul id="menu-content" class="menu-content collapse out">
                <li>
                  <a href="#">
                  <i class="fa fa-dashboard fa-lg"></i> Dashboard
                  </a>
                </li>

                <li  data-toggle="collapse" data-target="#products" class="collapsed active">
                  <a href="#"><i class="fa fa-gift fa-lg"></i> Productos<span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="products">
                    <li class="active"><a href="#">Alta de productos</a></li>
                </ul>


                <li data-toggle="collapse" data-target="#service" class="collapsed">
                  <a href="#"><i class="fa fa-globe fa-lg"></i> Altas <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="service">
                  <li>Alta de clientes</li>
                  <li>Alta de usuarios</li>
                </ul>


                <li data-toggle="collapse" data-target="#new" class="collapsed">
                  <a href="#"><i class="fa fa-car fa-lg"></i> Ventas <span class="arrow"></span></a>
                </li>
                <ul class="sub-menu collapse" id="new">
                  <li>Venta de productos</li>
                </ul>

                 <!-- <li>
                  <a href="#">
                  <i class="fa fa-user fa-lg"></i> Profile
                  </a>
                  </li>

                 <li>
                  <a href="#">
                  <i class="fa fa-users fa-lg"></i> Users
                  </a>
                </li> -->
            </ul>
     </div>
</div>
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
    <script src="{{ asset('js/bootstrap/popper.js') }}"></script>
    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('js/bootstrap/bootstrap.js') }}"></script>
    
    @show

    @section('scripts.DataTable')
        <script src="{{ asset('js//bootstrap/datatables.js') }}"></script>
        <script src="{{ asset('js/utils/datatable.js') }}"></script>
    @show

    @section('scripts.Select')
    <!--Script select 2 -->
        <script src="{{ asset('js//bootstrap/bootstrap-select.min.js') }}"></script>
        <script src="{{ asset('js//bootstrap/bootstrap-select.js') }}"></script>
    <!--  -->
    @show

    @section('scripts.personalizados')

    @show
</body>
</html>
