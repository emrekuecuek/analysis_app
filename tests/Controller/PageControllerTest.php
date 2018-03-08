<?php

namespace OCA\Analysis_App\Tests\Controller;

use OCA\Analysis_app\Controller\PageController;
use OCA\Analysis_app\FileModel;
use OCP\AppFramework\Http\TemplateResponse;
use Test\TestCase;


class PageControllerTest extends TestCase {
    /**
     * @params $appName
     * @params $fileModel
     * @params $request
     */
    private $appName;
    private $fileModel;
    private $request;
    private $expectedHtml;


    protected function setUp() {
        parent::setUp();
        $this->appName = $this->createMock('\OCA\Analysis_app\Controller\PageController');
        $this->request = $this->createMock('\OCP\IRequest');
        $this->fileModel = $this->createMock('\OCA\Analysis_app\FileModel');
        $this->expectedHtml = $this->getMockBuilder('OCP\AppFramework\Http\TemplateResponse')
            ->disableOriginalConstructor()
            ->setConstructorArgs(array($this->appName, 'index'));
    }

    public function testIndex() {

        $templateObj = new PageController($this->appName, $this->request, $this->fileModel);
        $this->assertTemplate($this->expectedHtml, $templateObj->index());




    }

    public function testGetInfo() {

    }
}
