@extends('Admin.layout')

@section('content_header')
    <h1>Список доменов</h1>
    <dl class="dl-horizontal">
        <dt>Дата</dt>
        <dd>{{$timemonitoring[1]}}</dd>
        <dt>Время сканироания</dt>
        <dd>{{$timemonitoring[0]}}</dd>
        <dd><a href="{{route('domains.index')}}" class="btn btn-success btn-sm">Обновить</a></dd>
    </dl>

@stop

@section('content')
    <div class="form-group">
        <a href="{{route('domains.create')}}" class="btn btn-success">Добавить</a>
    </div>
    <table id="example" class="display compact" style="width:100%">
        <thead>
        <tr>
            <th>id</th>
            <th>Домен</th>
            <th>ip</th>
            <th>Статус</th>
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
                <td>{{$domain['ip']}}</td>
                @if ($domain['status'] == 301 || $domain['status'] == 302 || $domain['status'] == 303)
                    <td class="text-warning">{{$domain['status']}}</td>
                @elseif ($domain['status'] == 403 || $domain['status'] == 504 || $domain['status'] == 0)
                    <td class="text-danger">{{$domain['status']}}</td>
                @else
                    <td class="text-success">{{$domain['status']}}</td>
                @endif
                @if($domain['expiry'] == '0')
                    <td {{$domain['expirystyle']}}>ручками</td>
                @else
                    <td class="{{$domain['expirystyle']}}">{{$domain['expiry']}}</td>
                @endif
                @if($domain['ssltime'] == '0')
                    <td {{$domain['sslstyle']}}>N/A</td>
                @else
                    <td class="{{$domain['sslstyle']}}">{{$domain['ssltime']}}</td>
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
            <th>Срок действия</th>
            <th>SSL Статус</th>
            <th>Действия</th>
        </tr>
        </tfoot>
    </table>
@endsection