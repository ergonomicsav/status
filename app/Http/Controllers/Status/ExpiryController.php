<?php

namespace App\Http\Controllers\Status;

use App\Models\Domain;
use App\Repositories\ExpiryScannerProcessing;
use App\Http\Controllers\Controller;

class ExpiryController extends Controller
{
    private $expiryScannerProcessing;

    public function __construct()
    {
        $this->middleware('auth');
        $this->expiryScannerProcessing = app(ExpiryScannerProcessing::class);
    }

    public function execute()
    {
        $domaims = Domain::all();
        foreach ($domaims as $domaim){
            $this->expiryScannerProcessing->processing($domaim);
        }
        return redirect()->route('domains.index');
    }
}
