<?php

namespace OCA\Analysis_app;

use OCP\Files\Folder;
use OCP\Files\Node;
use OCP\Util;

class FileModel {

    /**
     * @var array $biggestFiles
     */
    private $biggestFiles;

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
		$this->analyze($userFolder);
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
			arsort($this->biggestFiles);
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
	public function pushToBiggestFiles($item) {
	    $this->biggestFiles[$item->getName()] = $item->getSize();
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