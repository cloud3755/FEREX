@extends('layouts.layout')

@section('content')
    <style>
        .inicioCaja
        {
            background-color: #ceffb5;
        }

        .solidBorder, tfoot tr
        {
            border: 2px solid black;
        }
    </style>
    <!--<img width="700" height="150" src="http://www.ferex.com.mx/images/logo1abc.png">-->
    <h1 class="page-header">Corte de caja</h1>
    <pre>
FEREX<br>

    </pre>
    <pre>
<b>Fecha de impresi&oacute;n:</b>  {{$fechaImpresion}}<br>

    <table class="table">
        <thead>
        <tr>
            <th>Folio</th>
            <th>Cliente</th>
            <th>TOTAL</th>
            <th>SUMA</th>
        </tr>
        </thead>
        <tbody>
            <tr><td colspan="4"></td></tr>
        <tr class="inicioCaja"> 
            <td>--</td>
            <td>INICIO DE CAJA</td>
            <td>{{$openCaja->saldoSistema}}</td>
            <td>{{$openCaja->saldoSistema}}</td>
            @php
                $suma = $openCaja->saldoSistema;
            @endphp
        </tr>
        @foreach($Ventas as $venta)
            <tr>
            @php
                $suma += $venta->getTotal();
            @endphp
            <td>{{$venta->folio}}</td>
            <td>{{$venta->cliente->nombre}}</td>
            <td>{{$venta->getTotal()}}</td>
            <td>{{$suma}}</td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
            <tr class="solidBorder">
                <td colspan="4"></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Saldo al corte</td>
                <td>{{$corteCaja->saldoSistema}}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Saldo capturado</td>
                <td>{{$corteCaja->saldoCapturado}}</td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>Diferencia</td>
                <td data-diferencia="{{$corteCaja->saldoCapturado - $corteCaja->saldoSistema}}" id="diferenciaRow">{{intval(($corteCaja->saldoCapturado - $corteCaja->saldoSistema) * 1e2) / 1e2}}</td>
            </tr>
        </tfoot>
    </table>
    <hr>
@section('scripts.basic')
    @parent
    <script type="text/javascript">
        let diferencia = parseFloat($("#diferenciaRow").data("diferencia"));
        if(diferencia<0)
        {
            $("#diferenciaRow").css('background-color', 'red');
        }
        else
        {    
            $("#diferenciaRow").css('background-color', 'green');
        }
    </script>
@endsection

@endsection
