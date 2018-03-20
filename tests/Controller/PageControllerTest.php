<?php

namespace OCA\Analysis_App\Tests\Controller;

use OCA\Analysis_app\Controller\PageController;
use \OCP\AppFramework\Http\JSONResponse;
use OCP\IRequest;
use OCA\Analysis_app\FileModel;
use Test\TestCase;


class PageControllerTest extends TestCase {
    /** @var string $appName */
    private $appName;
    /** @var FileModel | \PHPUnit_Framework_MockObject_MockObject */
    private $fileModel;
    /** @var IRequest | \PHPUnit_Framework_MockObject_MockObject */
    private $request;
    /** @var  JSONResponse | \PHPUnit_Framework_MockObject_MockObject */
    private $jsonResponseMock;
    /** @var PageController $pageControllerObject */
    private $pageControllerObject;

    protected function setUp() {
        parent::setUp();
        $this->appName = 'analysis_app';
        $this->request = $this->createMock('\OCP\IRequest');
        $this->fileModel = $this->createMock('\OCA\Analysis_app\FileModel');
        $this->jsonResponseMock = $this->createMock('OCP\AppFramework\Http\JSONResponse');
        $this->fileModel->expects($this->any())->method('getAnalysisReport')
            ->willReturn(array());
        $this->pageControllerObject = new PageController($this->appName, $this->request, $this->fileModel);
    }

    public function testIndex() {
        $this->assertEquals(200,$this->pageControllerObject->index()->getStatus());
    }

    public function testGetInfo() {
        $this->assertInstanceOf(JSONResponse::class,$this->pageControllerObject->getInfo());
    }
}
