@extends('Admin.layout')

@section('content_header')
    <h1>{{$nameDomain}}</h1>
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
                           aria-selected="true">MYSQL</a>
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
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui
                        molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam
                        odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt
                        nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et
                        netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus
                        porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam
                        ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus
                        pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae
                        lectus. Cras lacinia erat eget sapien porta consectetur.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-system" role="tabpanel"
                         aria-labelledby="custom-tabs-one-system-tab">
                        Mauris tincidunt mi at erat gravida, eget tristique urna bibendum. Mauris pharetra purus ut
                        ligula tempor, et vulputate metus facilisis. Lorem ipsum dolor sit amet, consectetur adipiscing
                        elit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;
                        Maecenas sollicitudin, nisi a luctus interdum, nisl ligula placerat mi, quis posuere purus
                        ligula eu lectus. Donec nunc tellus, elementum sit amet ultricies at, posuere nec nunc. Nunc
                        euismod pellentesque diam.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-php" role="tabpanel"
                         aria-labelledby="custom-tabs-one-php-tab">
                        Morbi turpis dolor, vulputate vitae felis non, tincidunt congue mauris. Phasellus volutpat augue
                        id mi placerat mollis. Vivamus faucibus eu massa eget condimentum. Fusce nec hendrerit sem, ac
                        tristique nulla. Integer vestibulum orci odio. Cras nec augue ipsum. Suspendisse ut velit
                        condimentum, mattis urna a, malesuada nunc. Curabitur eleifend facilisis velit finibus
                        tristique. Nam vulputate, eros non luctus efficitur, ipsum odio volutpat massa, sit amet
                        sollicitudin est libero sed ipsum. Nulla lacinia, ex vitae gravida fermentum, lectus ipsum
                        gravida arcu, id fermentum metus arcu vel metus. Curabitur eget sem eu risus tincidunt eleifend
                        ac ornare magna.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-mysql" role="tabpanel"
                         aria-labelledby="custom-tabs-one-mysql-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis
                        ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate.
                        Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec
                        interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at
                        consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst.
                        Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-rsync" role="tabpanel"
                         aria-labelledby="custom-tabs-one-rsync-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis
                        ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate.
                        Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec
                        interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at
                        consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst.
                        Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                    <div class="tab-pane fade" id="custom-tabs-one-auth" role="tabpanel"
                         aria-labelledby="custom-tabs-one-auth-tab">
                        Pellentesque vestibulum commodo nibh nec blandit. Maecenas neque magna, iaculis tempus turpis
                        ac, ornare sodales tellus. Mauris eget blandit dolor. Quisque tincidunt venenatis vulputate.
                        Morbi euismod molestie tristique. Vestibulum consectetur dolor a vestibulum pharetra. Donec
                        interdum placerat urna nec pharetra. Etiam eget dapibus orci, eget aliquet urna. Nunc at
                        consequat diam. Nunc et felis ut nisl commodo dignissim. In hac habitasse platea dictumst.
                        Praesent imperdiet accumsan ex sit amet facilisis.
                    </div>
                </div>
            </div>
            <!-- /.card -->
        </div>
    </div>
</div>

@endsection