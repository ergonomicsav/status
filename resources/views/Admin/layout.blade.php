@extends('adminlte::page')

{{--@section('title', 'Dashboard')--}}

@section('content')
    @yield('content')
@stop

@section('css')
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script>$(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@stop