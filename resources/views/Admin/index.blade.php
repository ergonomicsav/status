@extends('Admin.layout')

@section('content_header')
    {{--    <h1>Список доменов</h1>--}}
    <div class="form-inline">
        <div class="form-group">
            <a href="{{route('domains.create')}}" class="btn btn-success" title="Добавить домен">Добавить домен</a>
        </div>
        <div class="form-group">
            <a href="/expiry" class="btn btn-success expiry-ssl-restart" title="Добавить домен">Обновить Expire
                domain</a>
        </div>
        <div class="form-group">
            <a href="/ssl" class="btn btn-success expiry-ssl-restart" title="Добавить домен">Обновить SSL статус</a>
        </div>
        <div class="form-group pull-right">
            <span>{{$timemonitoring[1]}}</span>
            <span><strong>{{$timemonitoring[0]}}</strong></span>
            <a href="{{route('domains.index')}}" class="btn btn-success">Обновить</a>
        </div>
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
            <th class="text-center">Действия</th>
        </tr>
        </thead>
        <tbody>
        @foreach($domains as $domain)
            <tr @if ($domain['closed'] == 1) style="background-color: #db709345" @endif>
                <td>{{$domain['id']}}</td>
                <td><a href="{{$domain['domain']}}" target="_blank" title="Перейти на сайт">{{$domain['name']}}</a></td>
                <td title="ip домена">{{$domain['ip']}}</td>
                <td><a href="/domain/{{$domain['name']}}" class="{{$domain['statusStyle']}}" title="Статус ответа">{{$domain['status']}}</a></td>
                <td title="Конечный сайт">{{$domain['redirect_url']}}</td>
                <td class="{{$domain['expirystyle']}}"
                    title="Дата окончания срока регистрации домена">{{$domain['expiry']}}</td>
                @if($domain['ssltime'] == '0')
                    <td {{$domain['sslstyle']}} title="Без сертификата">N/A</td>
                @else
                    <td class="{{$domain['sslstyle']}}" title="Дата окончания сертификата">{{$domain['ssltime']}}</td>
                @endif
                <td class="project-actions text-right">
                    <a href="{{route('domains.edit', $domain['id'])}}" class="btn btn-info btn-sm"
                       title="Редактировать"><i class="fas fa-pencil-alt"></i> Edit</a>
                    <form method="post" action="{{route('domains.destroy', $domain['id'])}}">
                        @method('delete')
                        @csrf
                        <button type="submit" onclick="return confirm('Ты уверен, что это надо удалить?')"
                                class="btn btn-danger btn-sm" title="Удалить"><i class="fas fa-trash"></i> Delete
                        </button>
                    </form>
                    <a href="{{route('home', ['leftDisk' => 'logs', 'leftPath' => $domain['namefolder']])}}"
                       class="btn btn-primary btn-sm" title="Перейти в файловый менеджер"><i class="fas fa-folder"></i>
                        View</a>
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
            <th class="text-center">Действия</th>
        </tr>
        </tfoot>
    </table>
@endsection