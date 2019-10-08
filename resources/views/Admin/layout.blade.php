@extends('adminlte::page')

{{--@section('title', 'Dashboard')--}}

@section('content')
    @yield('content')
@stop

@section('css')
    {{--    <link rel="stylesheet" href="/css/app.css">--}}
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{--<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css">--}}
{{--    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">--}}
    <link rel="stylesheet" href="{{ asset('vendor/file-manager/css/file-manager.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ asset('css/table.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/file-manager/js/file-manager.js') }}"></script>
    <script>$(document).ready(function () {
            $('#example').DataTable();
        });
    </script>
@stop
