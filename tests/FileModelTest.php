<?php

namespace OCA\Analysis_App\Tests;

use OCA\Analysis_app\FileModel;
use OCP\Files\Folder;
use OCP\Files\Node;
use Test\TestCase;

class FileModelTest extends TestCase {
    /** @var \PHPUnit_Framework_MockObject_MockObject | Folder $currentFolderMock */
    private $currentFolderMock;
    /** @var FileModel $fileModelObject */
    private $fileModelObject;
    /** @var Node | \PHPUnit_Framework_MockObject_MockObject */
    private $nodeMock1;
    /** @var Node | \PHPUnit_Framework_MockObject_MockObject */
    private $nodeMock2;

    protected function setUp() {
        parent::setUp();
        $this->nodeMock1 = $this->getMockBuilder(Node::class)->setMethods([])
            ->getMock();
        $this->nodeMock2 = $this->getMockBuilder(Node::class)->setMethods([])
            ->getMock();
        $this->currentFolderMock = $this->getMockBuilder(Folder::class)
            ->getMock();
        $this->nodeMock1->expects($this->any())
            ->method('getName')->will($this->returnValue('nodemock1.pdf'));
        $this->nodeMock1->expects($this->any())
            ->method('getSize')->will($this->returnValue(10));
        $this->nodeMock1->expects($this->any())
            ->method('getMimeType')->will($this->returnValue('application/pdf'));
        $this->nodeMock2->expects($this->any())
            ->method('getName')->will($this->returnValue('nodemock2.png'));
        $this->nodeMock2->expects($this->any())
            ->method('getSize')->will($this->returnValue(20));
        $this->nodeMock2->expects($this->any())
            ->method('getMimeType')->will($this->returnValue('image/png'));
        $this->currentFolderMock->expects($this->any())
            ->method('search')
            ->will($this->returnValue([$this->nodeMock1, $this->nodeMock2]));
        $this->fileModelObject = new FileModel($this->currentFolderMock);
    }

    public function testAnalyze() {
        $this->fileModelObject->analyze($this->currentFolderMock);
    }

    public function testGetAnalysisReport() {
        $expectedArray = [
            'biggest_files' => ['nodemock2.png' => 20, 'nodemock1.pdf' => 10],
            'mime_types' => ['application/pdf' => 10, 'image/png' => 20]
        ];
        $this->assertEquals($expectedArray, $this->fileModelObject->getAnalysisReport(2));
    }

    public function testPushToBiggestFile() {
        $this->fileModelObject->pushToBiggestFiles($this->nodeMock1);
    }
}