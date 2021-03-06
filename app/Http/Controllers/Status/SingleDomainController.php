<?php

namespace App\Http\Controllers\Status;

use App\Repositories\ParsingArrayLogs;

class SingleDomainController extends BaseController
{

    private $parsingArrayLogs;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->parsingArrayLogs = app(ParsingArrayLogs::class);
    }

    public function index(int $id = null)
    {
        $arrayLogs = $this->parsingArrayLogs->getArrLogs($id);
        return view('Admin.domain', ['letsencrypt' => $arrayLogs['Letsencrypt'], 'access' => $arrayLogs['Nginx']['access'], 'error' => $arrayLogs['Nginx']['error'], 'system' => $arrayLogs['Syslog'], 'phpfpm' => $arrayLogs['Phpfpm'], 'rsync' => $arrayLogs['Rsyncd'], 'authh' => $arrayLogs['Auth']]);
    }
}
