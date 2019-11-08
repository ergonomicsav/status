<?php


namespace App\Repositories;


class Nginx extends Handler implements Logs
{

    public function getArrayLogs()
    {
        // TODO: Implement getArrayLogs() method.
        $arr     = $this->getFiles();
        $string  = '';
        $string2 = '';

        foreach ($arr as $item) {
            if (strpos($item, 'error')) {
                $string                                .= $this->getStrings($item);
                $finishArr[$this->nameFolder]['error'] = explode("\n", $string);
            } else {
                $string2                                .= $this->getStrings($item);
                $finishArr[$this->nameFolder]['access'] = explode("\n", $string2);
            }
        }
//        dd($finishArr);
        return $finishArr;
    }
}