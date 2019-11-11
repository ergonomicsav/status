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
            $('#nginx').DataTable();
            $('#nginxaccess').DataTable();
            $('#system').DataTable();
            $('#letsencrypt').DataTable();
            $('#phpfpm').DataTable();
            $('#rsync').DataTable();
            $('#authh').DataTable();
        });
    </script>
    <script>
        window.onload = function()  {
            let loader = document.querySelector('.pace');
            let box = document.querySelector('.form-inline');

            if (box) {
                box.addEventListener('click', (el) => {
                    if(el.target.classList.contains('expiry-ssl-restart')) {
                        loader.classList.remove('pace-inactive');
                        loader.classList.add('pace-active');
                    }
                })
            }

        }

    </script>

@stop