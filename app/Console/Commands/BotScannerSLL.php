<?php

namespace App\Console\Commands;

use App\Models\Domain;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Telegram\Bot\Laravel\Facades\Telegram;

class BotScannerSLL extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:botssl';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'SSL Certificate Validation Message';

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
        $arrDomains = Domain::whereNotIn('ssltime', [0])->get();
        $arr = $arrDomains->sortByDesc('ssltime')->pluck('ssltime', 'domain');
        $message = '<b>SSL сертификат - осталось дней</b>' . PHP_EOL;
        $i = 1;
        foreach ($arr as $domain => $ssltime) {
            $date2 = Carbon::createFromTimestamp($ssltime);
            $diffDays = $this->date1->diffInDays($date2);
            if ($diffDays > 7) continue;
            $message .= $i . '. ' . $domain . ' - ' . '<b>' . $diffDays . '</b>' . PHP_EOL;
            $i++;
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
