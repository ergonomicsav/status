<?php

namespace App\Console\Commands;

use App\Models\Domain;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class BotScannerExpiryDomains extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:botexpiry';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Domain registration end date message';

    /**
     * Create a new command instance.
     *
     * @return void
     */

    private $date1;

    public function __construct()
    {
        parent::__construct();
        $this->date1 = Carbon::now();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $arrDomains = Domain::all();
        $arr = $arrDomains->sortBy('expiry')->pluck('expiry', 'domain');
        $message = '<b>Срок регистрации домена - осталось дней</b>' . PHP_EOL;
        $i = 1;
        foreach ($arr as $domain => $ssltime) {
            $date2 = Carbon::createFromTimestamp($ssltime);
            $diffDays = $this->date1->diffInDays($date2);
            if ($diffDays > 30) continue;
            $message .= $i . '. ' . $domain . ' - ' . '<b>' . $diffDays . '</b>' . PHP_EOL;
            $i++;
        }
//        dd($message);

        $message = trim($message);
        Telegram::sendMessage([
            'chat_id' => '-320333662',
            'parse_mode' => 'HTML',
            'disable_web_page_preview' => true,
            'text' => $message,
        ]);
    }
}
