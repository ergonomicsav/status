<?php


namespace App\Repositories;


use App\Models\Domain as Model;
use Storage;
use Arr;

class ParsingArrayLogs extends CoreRepository
{
    protected $storage;
    protected $contents = '';
    protected $finishArr = [];
    protected $processing;

    public function __construct()
    {
        parent::__construct();
        $this->storage = Storage::disk('logs');
        $this->processing = app(Processing::class);
    }

    protected function getModelClass()
    {
        return Model::class;
    }

    public function getArrLogs(int $id)
    {
        $obj = $this->model->find($id);
        $directories = $this->storage->directories($obj->namefolder);

        foreach ($directories as $directory) {
            $nameFolder = ltrim(strstr($directory, '/'), '/');
            $class = 'App\Repositories\\' . $nameFolder;
//            if (!$this->processing->running(new $class($directory, $nameFolder))) continue;
            $arr = $this->processing->running(new $class($directory, $nameFolder));
            $finishArr[$nameFolder] = $arr[$nameFolder];
        }
        if (empty($finishArr)) abort(404);
        return $finishArr;
    }


}