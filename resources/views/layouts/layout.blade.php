
<html lang="es">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

        <title>{{$title or "Cotizacion"}}</title>

    </head>
    <body>
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
@yield('content')
</div>
</div>
</div>
@section('scripts.basic')
    <script src="{{ asset('js/jquery-3.3.1.js') }}"></script>
    <script src="{{ asset('bootstrap3/js/bootstrap.min.js') }}"></script>
    <!--  <script src="{{ asset('js/app.js') }}"></script>-->
    <!--  <script src="{{ asset('bootstrap3/js/bootstrap.js') }}"></script>-->

    @show
</body>
</html>