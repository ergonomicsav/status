<?php


namespace App\Repositories;

use Storage;

class DirectoryManager
{
    private $storage;
    private $dir = ['/Auth', '/Letsencrypt', '/Nginx', '/Phpfpm', '/Rsyncd', '/Syslog'];

    public function __construct()
    {
        $this->storage = Storage::disk('logs');
    }

    public function createDirectories($rootDirectory)
    {
        foreach ($this->dir as $item) {
            $path = $rootDirectory . $item;
            $this->storage->makeDirectory($path);
        }

    }

    public function updateDirectories($oldNameFolder, $newNameFolder)
    {
        if ($newNameFolder == $oldNameFolder){
            $this->storage->deleteDirectory($oldNameFolder);
            foreach ($this->dir as $item) {
                $path = $newNameFolder . $item;
                $this->storage->makeDirectory($path);
            }
        }
    }

    public function removeDirectories($nameFolder)
    {
        $this->storage->deleteDirectory($nameFolder);
    }

}