<?php


namespace App\Repositories;

use App\Models\Domain as Model;
use Carbon\Carbon;


class StatusDomainRepository extends CoreRepository
{
    private $date1;


    protected function getModelClass()
    {
        return Model::class;
    }

    /**
     * @return mixed
     */
    public function getDomains()
    {

        //        foreach ($dms as $dm) {
//            $dm_new = 'https://' . $dm->name;
//            $dm->domain = $dm_new;
//            $dm->save();
//        }
//        dd($dms->pluck('ssltime')->all());
        $fields = ['id', 'name', 'ip', 'expiry', 'status', 'namefolder', 'domain', 'ssltime', 'closed'];
        $dms = $this->startConditions()->all($fields);
//        $dms = $this->startConditions()->select($fields)->paginate(25);
        $this->date1 = Carbon::now();

        foreach ($dms as $dm) {
            $pp = collect($dm);
            $pp = $this->expiryStyle($pp);
            $pp = $this->ssltimeStyle($pp);
            $aa[] = $pp;
        }
        return $aa;
    }

    private function expiryStyle($pp)
    {
        if ($pp['expiry'] == '0') {
            $pp['expirystyle'] = 'text-muted';
            return $pp;
        }
        $date2 = Carbon::createFromTimestamp($pp['expiry']);
        $diffDays = $this->date1->diffInDays($date2);
        $pp['expiry'] = date('d-m-Y', $pp['expiry']);
        if ($diffDays > 30) {
            $pp['expirystyle'] = 'text-success';
        } else {
            $pp['expirystyle'] = 'bg-danger';
        }
        return $pp;
    }

    private function ssltimeStyle($pp)
    {
        if ($pp['ssltime'] == '0') {
            $pp['sslstyle'] = 'text-muted';
            return $pp;
        }
        $date2 = Carbon::createFromTimestamp($pp['ssltime']);
        $diffDays = $this->date1->diffInDays($date2);
        $pp['ssltime'] = date('d-m-Y', $pp['ssltime']);
        if ($diffDays > 7) {
            $pp['sslstyle'] = 'text-success';
        } else {
            $pp['sslstyle'] = 'text-danger';
        }
        return $pp;
    }

    /**
     * @param $nameDomain
     */
    public
    function storeDomain($nameDomain)
    {
        $new_request = $nameDomain->all();
        $trimName = trim($new_request['name']);
        $new_request['domain'] = $new_request['domain'] . $trimName;
        $dm = str_replace('/', '-', $trimName);
        $new_request['namefolder'] = $dm;
        return $new_request;
    }

    public
    function updateDomain($item)
    {
        $new_request = $item->all();
        $trimName = trim($new_request['name']);
        $new_request['domain'] = $new_request['domain'] . $trimName;
        $dm = str_replace('/', '-', $trimName);
        $new_request['namefolder'] = $dm;
        return $new_request;
    }
}