<?php

namespace App\Console\Commands;

use App\Models\Domain;
use Illuminate\Console\Command;
use App\Repositories\ExpiryScannerProcessing;

class RunScannerExpiryDomain extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:expiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Determining the end of the domain registration date';
    /**
     * Create a new command instance.
     *
     * @return void
     */
    private $expiryScannerProcessing;

    public function __construct()
    {
        parent::__construct();
        $this->expiryScannerProcessing = app(ExpiryScannerProcessing::class);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $domaims = Domain::all();
        foreach ($domaims as $domaim) {
            $this->expiryScannerProcessing->processing($domaim);
        }
    }
}
