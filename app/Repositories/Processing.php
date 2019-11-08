<?php


namespace App\Repositories;


class Processing
{
    public function running(Logs $logs)
    {
        return $logs->getArrayLogs();
    }
}