<?php


namespace App\Repositories;


use App\Models\Domain as Model;
use Illuminate\Support\Facades\Cache;

class CollectionProcessing extends DomainsScannerProcessing
{
    public function processing($domains)
    {
        $dms = $domains->pluck('domain', 'id');
        $mh  = curl_multi_init();
        foreach ($dms as $key => $value) {
            $ch[$key] = curl_init($value);
            curl_setopt($ch[$key], CURLOPT_NOBODY, true);
            curl_setopt($ch[$key], CURLOPT_HEADER, true);
            curl_setopt($ch[$key], CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch[$key], CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch[$key], CURLOPT_SSL_VERIFYHOST, false);
//            curl_setopt($ch[$key], CURLOPT_FOLLOWLOCATION, true);

            curl_multi_add_handle($mh, $ch[$key]);
        }

// Запустк
        $running = null;
        do {
            curl_multi_exec($mh, $running);
            curl_multi_select($mh);
        } while ($running > 0);

// Собираем массив для БД
        foreach (array_keys($ch) as $key) {
            $reportArray[] = [
                'httpCode'     => curl_getinfo($ch[$key], CURLINFO_HTTP_CODE),
                'redirect_url' => curl_getinfo($ch[$key], CURLINFO_REDIRECT_URL),
                'id'           => $key,
                'ip'           => curl_getinfo($ch[$key], CURLINFO_PRIMARY_IP)
            ];

            curl_multi_remove_handle($mh, $ch[$key]);
        }

// Звкрываем curl
        curl_multi_close($mh);
// Запись в БД
        $this->updToBd($reportArray);
        Cache::put('new_time', date('H:i:s d/m/Y'));
//        Cache::put('new_time', date('H:i:s d/m/Y'), now()->addMinutes(1));
//        return redirect()->route('domains.index');

    }
}