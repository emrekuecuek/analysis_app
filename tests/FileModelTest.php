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
        $this->nodeMock1 = $this->getMockBuilder(Node::class)
            ->getMock();
        $this->nodeMock2 = $this->getMockBuilder(Node::class)
            ->getMock();
        $this->currentFolderMock = $this->getMockBuilder(Folder::class)
            ->getMock();
        $this->fileModelObject = new FileModel($this->currentFolderMock);
    }

    public function testAnalyze() {
        $this->nodeMock1->expects($this->any())
            ->method('getName')->will($this->returnValue('nodemock1.pdf'));
        $this->currentFolderMock->expects($this->any())
            ->method('search')
            ->will($this->returnValue([$this->nodeMock1, $this->nodeMock2]));
        $this->fileModelObject->analyze($this->currentFolderMock);
    }

    public function testGetAnalysisReport() {
        $this->nodeMock1->expects($this->any())->method('getName')
            ->will($this->returnValue('nodeMock1.pdf'));
        $this->nodeMock2->expects($this->any())->method('getSize')
            ->will($this->returnValue(20));
        $this->currentFolderMock
            ->expects($this->any())
            ->method('search')
            ->will($this->returnValue([$this->nodeMock1, $this->nodeMock2]));
        $this->assertArrayHasKey('biggest_files',$this->fileModelObject->getAnalysisReport());
        $this->assertArrayHasKey('mime_types',$this->fileModelObject->getAnalysisReport());

        //Since names of biggest_files are stored as key values as in an associative array, I thought it would be better to test it with assertArrayHasKey.

        $this->assertArrayHasKey($this->nodeMock1->getName(), $this->fileModelObject->getAnalysisReport()['biggest_files']);
        $this->assertEquals(20, $this->fileModelObject->getAnalysisReport()['biggest_files']['']);

    }


    public function testPushToBiggestFile() {
        $this->nodeMock1->expects($this->any())->method('getName')
            ->will($this->returnValue('nodeMock1.pdf'));
        $this->fileModelObject->pushToBiggestFiles($this->nodeMock1);
    }

}