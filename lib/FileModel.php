<?php

namespace OCA\Analysis_app;

use OCP\Files\Folder;

class FileModel {
    /**
     * @var array[][] $fileEverything
     */
    private $fileEverything;

    /**
     * FileModel constructor.
     */
    public function __construct() {
        $this->determineEverything(\OC::$server->getUserFolder());
    }
    /**
     * @param Folder $currentDirectory
     */
    public function determineEverything($currentDirectory){
        foreach ($currentDirectory->search('') as $item) {
            if ($item->getMimetype() == 'http/unix-directory') {
                $this->determineEverything($item);
            } else {

                if(count($this->fileEverything['fileList'])<10
                    || $item->getSize()>array_values($this->fileEverything['fileList'][9])
                ) {

                    $this->fileEverything['fileList'][$item->getPath()]= $item->getSize();
                    arsort($this->fileEverything['fileList']);
                }
                if(!isset($this->fileEverything['mimeList'][$item->getMimetype()])) {
                    $this->fileEverything['mimeList'][$item->getMimetype()] = $item->getSize();
                } else {
                    $this->fileEverything['mimeList'][$item->getMimetype()] += $item->getSize();
                }
            }
        }
    }
    /**
     * @return array
     */
    public function returnEverything() {
        return $this->fileEverything;
    }
}
