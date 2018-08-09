@extends('layouts.app')
@section('styles')
  @parent
@endsection
@section('content')



@endsection
  @section('scripts.personalizados')
  @parent
    <script src="{{ asset('js/productos/productosApp.js') }}"></script>
  @endsection
