<?php

namespace OCA\Analysis_App\Tests\Controller;

use OCA\Analysis_app\Controller\PageController;
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
    /** @var PageController $templateObj*/
    private $templateObj;

    protected function setUp() {
        parent::setUp();
        $this->appName = 'analysis_app';
        $this->request = $this->createMock('\OCP\IRequest');
        $this->fileModel = $this->createMock('\OCA\Analysis_app\FileModel');
        $this->templateObj = new PageController($this->appName, $this->request, $this->fileModel);
    }

    public function testIndex() {
        $this->assertEquals(200,$this->templateObj->index()->getStatus());
    }

    public function testGetInfo() {

    }
}
