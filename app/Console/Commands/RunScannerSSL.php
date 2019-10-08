<?php

namespace App\Console\Commands;

use App\Models\Domain;
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
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Получение граничных дат SSL сертификатов
     *
     * @return mixed
     */
    public function handle()
    {
        $domaims = Domain::all();
        $names = $domaims->reject(function ($domain) {
            return $domain->closed == 1;
        });
        $dms = $names->pluck('domain', 'id');
        foreach ($dms as $id => $dm) {
            if (!strpos($dm, 'ttps://')) {
                $validTo_time = 0;
                $this->upddateSll($id, $validTo_time);
                continue;
            }
            $orignal_parse = parse_url($dm, PHP_URL_HOST);
            $get = stream_context_create(array("ssl" => array("capture_peer_cert" => TRUE)));
            $read = stream_socket_client("ssl://" . $orignal_parse . ":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
            $cert = stream_context_get_params($read);
            $certinfo = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
            if ($certinfo == false) {
                $validTo_time = -1;
                $this->upddateSll($id, $validTo_time);
                continue;
            }
            $validTo_time = $certinfo['validTo_time_t'];
            $this->upddateSll($id, $validTo_time);
        }


    }
    private function upddateSll($id, $val){
        $domains = Domain::find($id);
        $domains->ssltime = $val;
        $domains->save();
    }
}
