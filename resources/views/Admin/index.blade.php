@extends('Admin.layout')

@section('content_header')
    {{--    <h1>Список доменов</h1>--}}
    <div class="form-inline" style="margin-bottom: 20px">
        <div class="form-group">
            <a href="{{route('domains.create')}}" class="btn btn-success" title="Добавить домен">Добавить домен</a>
        </div>
        <div class="form-group">
            <a href="#" class="btn btn-success" title="Добавить домен">Обновить период регистрации доменов</a>
        </div>
        <div class="form-group">
            <a href="#" class="btn btn-success" title="Добавить домен">Обновить SSL статус</a>
        </div>
        <dl class="dl-horizontal form-group pull-right">
            <dt>Дата</dt>
            <dd>{{$timemonitoring[1]}}</dd>
            <dt>Время сканироания</dt>
            <dd>{{$timemonitoring[0]}}</dd>
            <dd><a href="{{route('domains.index')}}" class="btn btn-success btn-sm">Обновить</a></dd>
        </dl>
    </div>


@stop

@section('content')


    <table id="example" class="display compact" style="width:100%">
        <thead>
        <tr>
            <th>id</th>
            <th>Домен</th>
            <th>ip</th>
            <th>Статус</th>
            <th>URI редирект</th>
            <th>Срок действия</th>
            <th>SSL Статус</th>
            <th>Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($domains as $domain)
            <tr @if ($domain['closed'] == 1) style="background-color: #db709345" @endif>
                <td>{{$domain['id']}}</td>
                <td><a href="{{$domain['domain']}}" target="_blank" title="Перейти на сайт">{{$domain['name']}}</a></td>
                <td title="ip домена">{{$domain['ip']}}</td>
                <td><a href="#" class="{{$domain['statusStyle']}}" title="Статус ответа">{{$domain['status']}}</a></td>
                <td title="Конечный сайт">{{$domain['redirect_url']}}</td>
                <td class="{{$domain['expirystyle']}}"
                    title="Дата окончания срока регистрации домена">{{$domain['expiry']}}</td>
                @if($domain['ssltime'] == '0')
                    <td {{$domain['sslstyle']}} title="Без сертификата">N/A</td>
                @else
                    <td class="{{$domain['sslstyle']}}" title="Дата окончания сертификата">{{$domain['ssltime']}}</td>
                @endif
                <td><a href="{{route('domains.edit', $domain['id'])}}" class="far fa-edit" title="Редактировать"></a>
                    <form method="post" action="{{route('domains.destroy', $domain['id'])}}">
                        @method('delete')
                        @csrf
                        <button type="submit" onclick="return confirm('Ты уверен, что это надо удалить?')"
                                class="delete" title="Удалить"><i class="far fa-trash-alt"></i></button>
                    </form>
                    <a href="{{route('home', ['leftDisk' => 'logs', 'leftPath' => $domain['namefolder']])}}"
                       class="far fa-folder-open" title="Перейти в файловый менеджер"></a>
                </td>
            </tr>
        @endforeach
        </tbody>
        <tfoot>
        <tr>
            <th>id</th>
            <th>Домен</th>
            <th>ip</th>
            <th>Статус</th>
            <th>URI редирект</th>
            <th>Срок действия</th>
            <th>SSL Статус</th>
            <th>Действия</th>
        </tr>
        </tfoot>
    </table>
@endsection