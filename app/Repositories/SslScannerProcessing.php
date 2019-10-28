<?php


namespace App\Repositories;

use App\Models\Domain as Model;

class SslScannerProcessing extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

    public function processing(Model $dms)
    {
        if ($dms->closed == 1 || parse_url($dms->domain, PHP_URL_SCHEME) == 'http') {
            $validTo_time = 0;
            $this->upddateSll($dms->id, $validTo_time);
            return;
        }
        $orignal_parse = parse_url($dms->domain, PHP_URL_HOST);
        $get           = stream_context_create(["ssl" => ["capture_peer_cert" => TRUE]]);
        $read          = stream_socket_client("ssl://" . $orignal_parse . ":443", $errno, $errstr, 30, STREAM_CLIENT_CONNECT, $get);
        $cert          = stream_context_get_params($read);
        $certinfo      = openssl_x509_parse($cert['options']['ssl']['peer_certificate']);
        if ($certinfo == false) {
            $validTo_time = -1;
            $this->upddateSll($dms->id, $validTo_time);
            return;
        }
        $validTo_time = $certinfo['validTo_time_t'];
        $this->upddateSll($dms->id, $validTo_time);

    }

    private function upddateSll($id, $val)
    {
        $domains          = $this->startConditions()::find($id);
        $domains->ssltime = $val;
        $domains->save();

    }

}