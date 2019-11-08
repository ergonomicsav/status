<?php


namespace App\Repositories;


use Storage;

class Handler
{
    protected $directory;
    protected $nameFolder;
    protected $storage;

    public function __construct($directory, $nameFolder)
    {
        $this->directory  = $directory;
        $this->nameFolder = $nameFolder;
        $this->storage    = Storage::disk('logs');
    }

    protected function getFiles()
    {
        return $this->storage->files($this->directory);
    }

    protected function getStrings($nameFile)
    {
       return $this->storage->get($nameFile);
    }
}