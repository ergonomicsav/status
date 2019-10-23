<?php

namespace App\Console\Commands;

use App\Models\Domain;
use App\Repositories\SslScannerProcessing;
use Illuminate\Console\Command;

class RunScannerSSL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ssl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Certificate SSL Verification';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private $sslScannerProcessing;

    public function __construct()
    {
        parent::__construct();
        $this->sslScannerProcessing = app(SslScannerProcessing::class);
    }

    /**
     * Получение граничных дат SSL сертификатов
     *
     * @return mixed
     */
    public function handle()
    {
        $domaims = Domain::all();
        foreach ($domaims as $domaim){
            $this->sslScannerProcessing->processing($domaim);
        }
    }
}
