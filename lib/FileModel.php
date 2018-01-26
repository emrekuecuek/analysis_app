<?php

namespace OCA\Analysis_app;

use OCP\Files\Folder;
use OCP\Files\Node;
use function Sabre\VObject\write;

class FileModel {
    /**
     * @var Node[] $biggestFileNodes
     */
    private $biggestFileNodes;

    /**
     * @var array $mimeTypes
     */
    private $mimeTypes;

    /**
     * @var array $biggestFiles
     */
    private $biggestFiles;

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
                continue;
            }
            $this->pushToBiggestFilesIfNecessary($item);
            $this->analyzeMimeType($item);
        }
        $this->convertBiggestFilesNodeToArray();
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
        if (count($this->biggestFileNodes) < 10
            || $item->getSize() > $this->biggestFileNodes[9]->getSize()
        ) {
            $this->biggestFileNodes[9] = $item;
            usort($this->biggestFileNodes, function (Node $a, Node $b) {
                return $a->getSize() < $b->getSize();
            });
        }
    }

    public function convertBiggestFilesNodeToArray() {
        foreach ($this->biggestFileNodes as $node) {
            $this->biggestFiles[$node->getName()] = $node->getSize();
        }
        arsort($this->biggestFiles);
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