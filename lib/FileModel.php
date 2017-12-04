<?php

namespace OCA\Analysis_app;

use OCP\Files\Folder;
use OCP\Files\Node;

class FileModel {

    /**
     * @var array $fileMimeTypesInfo
     * @var array $sortedFileSizes
     */
    private $fileMimeTypesInfo;
    private $fileSortingAsSize;
    /**
     * FileModel constructor.
     */
    public function __construct(){
        $this->determineFileMimeTypesInfo(\OC::$server->getUserFolder());
        $this->determineBiggestFiles(\OC::$server->getUserFolder());
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
     * @param Folder $currentDirectory
     */
    public function determineBiggestFiles($currentDirectory) {
        foreach ($currentDirectory->search('') as $item) {
            if ($item->getMimetype() == 'http/unix-directory') {
                $this->determineBiggestFiles($item);
            } else {
                $this->fileSortingAsSize[$item->getName()] = $item->getSize();
            }
        }
    }
    /**
     * @return array
     */
    public function getFileSortingAsSize() {
        return $this->fileSortingAsSize;
    }
    /**
     * @param array $fileSortingAsSize
     */
    public function setFileSortingAsSize($fileSortingAsSize) {
        $this->fileSortingAsSize = $fileSortingAsSize;
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

