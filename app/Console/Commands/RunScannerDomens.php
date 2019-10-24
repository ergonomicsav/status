<?php

namespace App\Console\Commands;

use App\Models\Domain;
use App\Repositories\CollectionProcessing;
use Illuminate\Console\Command;


class RunScannerDomens extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:monitoring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Domain scanning for monitoring purposes';

    private $collectionProcessing;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
        $this->collectionProcessing = app(CollectionProcessing::class);
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $domains = Domain::all();
        $this->collectionProcessing->processing($domains);
    }

}
