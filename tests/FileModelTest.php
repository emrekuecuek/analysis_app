<?php

namespace OCA\Analysis_App\Tests;

use OCA\Analysis_app\FileModel;
use OCP\Files\Folder;
use OCP\Files\Node;
use Test\TestCase;

class FileModelTest extends TestCase {
    /** @var Folder $currentFolderMock | \PHPUnit_Framework_MockObject_MockObject */
    private $currentFolderMock;
    /** @var FileModel $fileModelObject */
    private $fileModelObject;
    /** @var Node | \PHPUnit_Framework_MockObject_MockObject */
    private $nodeMock1;
    /** @var Node | \PHPUnit_Framework_MockObject_MockObject */
    private $nodeMock2;

    protected function setUp() {
        parent::setUp();
        $this->currentFolderMock = $this->createMock(Folder::class);
        $this->nodeMock1 = $this->createMock(Node::class)
            ->expects($this->once())
            ->method('getName')->willReturn('nodeMock1 test Name')
            ->method('getSize')->willReturn(10)
            ->method('getMimeType')->willReturn('testMimeType');
        $this->nodeMock2 = $this->createMock(Node::class)
            ->expects($this->once())
            ->method('getName')->willReturn('nodeMock2 test Name')
            ->method('getSize')->willReturn(20);
        $this->fileModelObject = new FileModel($this->currentFolderMock);
    }
}