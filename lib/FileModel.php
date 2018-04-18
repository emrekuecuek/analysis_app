<?php

namespace OCA\Analysis_app;

use OCP\Files\Folder;
use OCP\Files\Node;

class FileModel {

    /**
     * @var array $biggestFiles
     */
    private $biggestFiles = [];

	/**
	 * @var array $mimeTypes
	 */
	private $mimeTypes;

	/**
	 * @var Folder $userFolder
	 */
	private $userFolder;

	/**
	 * FileModel constructor.
	 *
	 * @param Folder $userFolder
	 */
	public function __construct($userFolder) {
		$this->userFolder = $userFolder;

	}
	/**
	 * @param Folder $currentDirectory
	 */
	public function analyze($currentDirectory) {
		foreach ($currentDirectory->search('') as $item) {
			if ($item instanceof Folder) {
				continue;
			}
			$this->pushToBiggestFiles($item);
			$this->analyzeMimeType($item);
		}

	}
	/**
     * @var array $biggestFilesSorted
	 * @return array
	 */
	public function getAnalysisReport($fileNumberToBeSorted) {
        $this->analyze($this->userFolder);
        $biggestFilesSorted = [];

        usort($this->biggestFiles, function($a, $b) {
            return $a[1] < $b[1];
        });

        if (count($this->biggestFiles)<$fileNumberToBeSorted) {
            $fileNumberToBeSorted = count($this->biggestFiles);
        }

        for ($i = 0; $i<$fileNumberToBeSorted; $i++) {
            $biggestFilesSorted[$this->biggestFiles[$i][0]] = $this->biggestFiles[$i][1];
        }


	    return [
			'biggest_files' => $biggestFilesSorted,
			'mime_types' => $this->mimeTypes
		];
	}

    /**
	 * @param Node $item
	 */
	public function analyzeMimeType($item) {
		if (!isset($this->mimeTypes[$item->getMimetype()])) {
			$this->mimeTypes[$item->getMimetype()] = $item->getSize();
		} else {
			$this->mimeTypes[$item->getMimetype()] += $item->getSize();
		}
	}

    /**
     * @param Node $item
     */
    public function pushToBiggestFiles($item) {
        array_push($this->biggestFiles, [$item->getName(),$item->getSize()]);
    }
}