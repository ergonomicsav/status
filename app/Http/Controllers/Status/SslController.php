<?php

namespace App\Http\Controllers\Status;

use App\Models\Domain;
use App\Repositories\SslScannerProcessing;
use App\Http\Controllers\Controller;

class SslController extends Controller
{
    private $sslScannerProcessing;

    public function __construct()
    {
        $this->middleware('auth');
        $this->sslScannerProcessing = app(SslScannerProcessing::class);
    }

    public function execute()
    {
        $domaims = Domain::all();
        foreach ($domaims as $domaim){
            $this->sslScannerProcessing->processing($domaim);
        }
        return redirect()->route('domains.index');
    }
}
