<?php


namespace App\Repositories;


use App\Models\Domain as Model;
use Illuminate\Support\Facades\Cache;

class ModelProcessing extends DomainsScannerProcessing
{
    public function processing(Model $domains)
    {
//        dd($domains);
//        $dms = $domains->pluck('domain', 'id');

        $mh = curl_multi_init();
//        foreach ($dms as $key => $value) {
        $ch[$domains->id] = curl_init($domains->domain);
        curl_setopt($ch[$domains->id], CURLOPT_NOBODY, true);
        curl_setopt($ch[$domains->id], CURLOPT_HEADER, true);
        curl_setopt($ch[$domains->id], CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch[$domains->id], CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch[$domains->id], CURLOPT_SSL_VERIFYHOST, false);
//            curl_setopt($ch[$domains->id], CURLOPT_FOLLOWLOCATION, true);

        curl_multi_add_handle($mh, $ch[$domains->id]);
//        }

// Запустк
        $running = null;
        do {
            curl_multi_exec($mh, $running);
            curl_multi_select($mh);
        } while ($running > 0);

// Собираем массив для БД
        foreach (array_keys($ch) as $domains->id) {
            $reportArray[] = [
                'httpCode'     => curl_getinfo($ch[$domains->id], CURLINFO_HTTP_CODE),
                'redirect_url' => curl_getinfo($ch[$domains->id], CURLINFO_REDIRECT_URL),
                'id'           => $domains->id,
                'ip'           => curl_getinfo($ch[$domains->id], CURLINFO_PRIMARY_IP)
            ];

            curl_multi_remove_handle($mh, $ch[$domains->id]);
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