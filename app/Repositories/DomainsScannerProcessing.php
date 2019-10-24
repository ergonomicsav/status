<?php

namespace App\Repositories;


use App\Models\Domain as Model;
use Illuminate\Support\Facades\Cache;

class DomainsScannerProcessing extends CoreRepository
{
    protected function getModelClass()
    {
        return Model::class;
    }

     protected function updToBd($items)
    {
        if ($items) {
            foreach ($items as $var) {
                $domains = Model::find($var['id']);
                $domains->ip = $var['ip'];
                $domains->redirect_url = $var['redirect_url'] ? $var['redirect_url'] : 'нет';
                $domains->status = $var['httpCode'];
                $domains->save();
            }
        }
    }

}