<?php

namespace OCA\Analysis_app;

use OCP\Files\Folder;
use OCP\Files\Node;

class FileModel {
    /**
     * @var Node[] $biggestFiles
     */
    private $biggestFiles;

    /**
     * @var array $mimeTypes
     */
    private $mimeTypes;

    /**
     * FileModel constructor.
     */
    public function __construct() {
        $this->analyze(\OC::$server->getUserFolder());
    }
    /**
     * @param Folder $currentDirectory
     */
    public function analyze($currentDirectory) {
        foreach ($currentDirectory->search('') as $item) {
            if ($item instanceof Folder) {
                $this->analyze($item);
                continue;
            }
            $this->pushToBiggestFilesIfNecessary($item);
            $this->analyzeMimeType($item);
        }
    }
    /**
     * @return array
     */
    public function getAnalysisReport() {
        return [
            'biggest_files' => $this->biggestFiles,
            'mime_types' => $this->mimeTypes
        ];
    }

    /**
     * @param Node $item
     */
    public function pushToBiggestFilesIfNecessary($item) {
        if (count($this->biggestFiles) < 10
            || $item->getSize() > $this->biggestFiles[9]->getSize()
        ) {
            $this->biggestFiles[9] = $item;
            usort($this->biggestFiles, function (Node $a, Node $b) {
                return $a->getSize() < $b->getSize();
            });
        }
    }

    /**
     * @param Node $item
     */
    public function analyzeMimeType($item)
    {
        if (!isset($this->mimeTypes[$item->getMimetype()])) {
            $this->mimeTypes[$item->getMimetype()] = $item->getSize();
        } else {
            $this->mimeTypes[$item->getMimetype()] += $item->getSize();
        }
    }
}