<?php

namespace App\Console\Commands;

use App\Models\Domain;
use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class BotScannerDomains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:botmonitoring';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sending a message to the bot telegram channel';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $arrDomains = Domain::whereNotIn('status', [200])->get();
        $arr = $arrDomains->sortByDesc('status')->pluck('status', 'domain');
        $message = '<b>Мониторинг</b>' . PHP_EOL;
        foreach ($arr as $domain => $status){
            $message .= $domain . ' &gt; ' . '<b>' . $status . '</b>' . PHP_EOL;
        }
        $message = trim($message);
        Telegram::sendMessage([
            'chat_id' => '-320333662',
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
            'text' => $message,
        ]);
    }
}
