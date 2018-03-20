<?php

namespace OCA\Analysis_App\Tests;

use OCA\Analysis_app\FileModel;
use Test\TestCase;

class FileModelTest extends TestCase {
    /** @var $currentFolderMock | \PHPUnit_Framework_MockObject_MockObject */
    private $currentFolderMock;
    /** @var FileModel $fileModelObject */
    private $fileModelObject;

    protected function setUp() {
        parent::setUp();
        $this->currentFolderMock = $this->getMockBuilder('OCP\Files\Folder')
            ->getMock();
        $this->fileModelObject = new FileModel($this->currentFolderMock);
    }

    public function testGetAnalysisReport() {
        $this->assertArrayHasKey(array('biggest_files','mime_types'),$this->fileModelObject->getAnalysisReport());
    }
}