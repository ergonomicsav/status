<?php


namespace App\Repositories;


class Syslog extends Handler implements Logs
{
    public function getArrayLogs()
    {
        // TODO: Implement getArrayLogs() method.
        $arr    = $this->getFiles();
        $string = '';

        foreach ($arr as $item) {
            $string                       .= $this->getStrings($item);
            $finishArr[$this->nameFolder] = explode("\n", $string);

        }
//        dd($finishArr);
        return $finishArr;
    }
}