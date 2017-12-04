<?php

namespace OCA\Analysis_app;

use OCP\Files\Folder;
use OCP\Files\Node;

class FileModel {

    /**
     * @var array $fileMimeTypesInfo
     */
    private $fileMimeTypesInfo;
    /**
     * FileModel constructor.
     */
    public function __construct(){
        $this->determineFileMimeTypesInfo(\OC::$server->getUserFolder());
    }

    /**
     * @param Folder $currentDirectory
     */
    public function determineFileMimeTypesInfo($currentDirectory) {
        foreach ($currentDirectory->search('') as $item){
            if ($item->getMimetype() == 'http/unix-directory') {
                $this->determineFileMimeTypesInfo($item);
            } else {
                if(!isset($this->fileMimeTypesInfo[$item->getMimetype()])) {
                    $this->fileMimeTypesInfo[$item->getMimetype()] = $item->getSize();
                } else {
                    $this->fileMimeTypesInfo[$item->getMimetype()] += $item->getSize();
                }
            }
        }
    }

    /**
     * @return array
     */
    public function getFileMimeTypesInfo() {
        return $this->fileMimeTypesInfo;
    }

    /**
     * @param array $fileMimeTypesInfo
     */
    public function setFileMimeTypesInfo($fileMimeTypesInfo) {
        $this->fileMimeTypesInfo = $fileMimeTypesInfo;
    }
}
