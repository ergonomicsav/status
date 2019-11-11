@extends('Admin.layout')

@section('content_header')
    {{--    <h1>{{$id}}</h1>--}}
@stop

@section('content')
    <div class="row">
        <div class="col-12 col-sm-6 col-lg-12">
            <div class="card card-primary card-tabs">
                <div class="card-header p-0 pt-1">
                    <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-nginx-tab" data-toggle="pill"
                               href="#custom-tabs-one-nginx" role="tab" aria-controls="custom-tabs-one-nginx"
                               aria-selected="false">NGINX</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-system-tab" data-toggle="pill"
                               href="#custom-tabs-one-system" role="tab" aria-controls="custom-tabs-one-system"
                               aria-selected="false">SYSTEM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-php-tab" data-toggle="pill"
                               href="#custom-tabs-one-php" role="tab" aria-controls="custom-tabs-one-php"
                               aria-selected="false">PHP-FPM</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-mysql-tab" data-toggle="pill"
                               href="#custom-tabs-one-mysql" role="tab" aria-controls="custom-tabs-one-mysql"
                               aria-selected="true">LETSENCRYPT</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-rsync-tab" data-toggle="pill"
                               href="#custom-tabs-one-rsync" role="tab" aria-controls="custom-tabs-one-rsync"
                               aria-selected="true">RSYNC</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="custom-tabs-one-auth-tab" data-toggle="pill"
                               href="#custom-tabs-one-auth" role="tab" aria-controls="custom-tabs-one-auth"
                               aria-selected="true">AUTH</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="custom-tabs-one-tabContent">
                        <div class="tab-pane fade" id="custom-tabs-one-nginx" role="tabpanel"
                             aria-labelledby="custom-tabs-one-nginx-tab">
                            <h2>Error.log</h2>
                            <table id="nginx" class="display compact" style="width:100%">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Строки</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($error)
                                    @foreach($error as $key => $log)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$log}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>№</th>
                                    <th>Строкм</th>
                                </tr>
                                </tfoot>
                            </table>
                            <h2>Access.log</h2>
                            <table id="nginxaccess" class="display compact" style="width:100%">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Строки</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($access)
                                    @foreach($access as $key => $log)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$log}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>№</th>
                                    <th>Строкм</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-system" role="tabpanel"
                             aria-labelledby="custom-tabs-one-system-tab">
                            <table id="system" class="display compact" style="width:100%">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Строки</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($system)
                                    @foreach($system as $key => $log)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$log}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>№</th>
                                    <th>Строкм</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-php" role="tabpanel"
                             aria-labelledby="custom-tabs-one-php-tab">
                            <table id="phpfpm" class="display compact" style="width:100%">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Строки</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($phpfpm)
                                    @foreach($phpfpm as $key => $log)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$log}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>№</th>
                                    <th>Строкм</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-mysql" role="tabpanel"
                             aria-labelledby="custom-tabs-one-mysql-tab">
                            <table id="letsencrypt" class="display compact" style="width:100%">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Строки</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($letsencrypt)
                                    @foreach($letsencrypt as $key => $log)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$log}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>№</th>
                                    <th>Строкм</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-rsync" role="tabpanel"
                             aria-labelledby="custom-tabs-one-rsync-tab">
                            <table id="rsync" class="display compact" style="width:100%">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Строки</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($rsync)
                                    @foreach($rsync as $key => $log)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$log}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>№</th>
                                    <th>Строкм</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                        <div class="tab-pane fade" id="custom-tabs-one-auth" role="tabpanel"
                             aria-labelledby="custom-tabs-one-auth-tab">
                            <table id="authh" class="display compact" style="width:100%">
                                <thead>
                                <tr>
                                    <th>№</th>
                                    <th>Строки</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if($authh)
                                    @foreach($authh as $key => $log)
                                        <tr>
                                            <td>{{$key}}</td>
                                            <td>{{$log}}</td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                                <tfoot>
                                <tr>
                                    <th>№</th>
                                    <th>Строкм</th>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
                <!-- /.card -->
            </div>
        </div>
    </div>

@endsection