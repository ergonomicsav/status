@extends('Admin.layout')

@section('content_header')
    <h1>Редактирование
        <small>приятные слова..</small>
    </h1>
@stop
@section('content')

    <!-- Main content -->
    <section class="content">

        <!-- Default box -->
        <div class="box">
            <form method="post" action="{{route('domains.update', $domain->id)}}">
                @method('put')
                @csrf
                <div class="box-header with-border">
                    <h3 class="box-title">Редактируем имя домена</h3>
                    @include('Admin.errors')
                </div>
                <div class="box-body">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Название</label>
                            <input type="text" class="form-control" id="exampleInputEmail1" placeholder="" name="name"
                                   value="{{$domain->name}}">
                        </div>
                        <div class="form-group">
                            <label for="expiry">Срок действия домена</label>
                            <input type="date" class="form-control" id="expiry" placeholder="" name="expiry"
                                   value="{{$domain->expiry}}" disabled>
                        </div>
                        <div class="form-group">
                            @if($domain->radio == 'http')
                                <label class="radio-inline">
                                    <input type="radio" name="domain" id="two" value="http://" checked> http://
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="domain" id="one" value="https://"
                                           @if($domain->radio == 1) checked @endif> https://
                                </label>
                            @else
                                <label class="radio-inline">
                                    <input type="radio" name="domain" id="two" value="http://"> http://
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="domain" id="one" value="https://" checked> https://
                                </label>
                            @endif
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="closed" id="four" value="0">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="closed" id="three" value="1"
                                       @if($domain->closed == 1) checked @endif> Исключить
                            </label>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="manual" id="five" value="0">
                            <label class="checkbox-inline">
                                <input type="checkbox" value="1" id="five-visible" name="manual"
                                       @if($domain->manual == 1) checked
                                       @endif onchange="document.getElementById('expiry').disabled = !this.checked;"/>
                                Ручной ввод даты
                            </label>
                        </div>
                    </div>
                </div>

                <!-- /.box-body -->
                <div class="box-footer">
                    <a href="{{route('domains.index')}}" class="btn btn-default">Назад</a>
                    <button class="btn btn-success pull-right">Изменить</button>
                </div>
                <!-- /.box-footer-->
            </form>
        </div>
        <!-- /.box -->

    </section>
    <!-- /.content -->

    <!-- /.content-wrapper -->
@endsection