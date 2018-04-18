<?php
/**
 * Created by PhpStorm.
 * User: kucuk
 * Date: 27.10.2017
 * Time: 21:06
 */
namespace OCA\Analysis_app\Controller;
use OCA\Analysis_app\FileModel;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\JSONResponse;
use OCP\AppFramework\Http\TemplateResponse;
use OCP\IRequest;


class PageController extends Controller {
    /**
     * @var FileModel $fileModel;
     */
    private $fileModel;

    /***
     * PageController constructor.
     * @param string $appName
     * @param IRequest $request
     * @param FileModel $fileModel
     */
    public function __construct(
        $appName,
        IRequest $request,
        FileModel $fileModel

    ) {
        parent::__construct($appName, $request);
        $this->fileModel = $fileModel;
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     * @return TemplateResponse TemplateResponse
     */
    public function index() {
        $templateResponse = new TemplateResponse(
            $this->appName,
            'index'
        );
        return $templateResponse;
    }

    /**
     * @NoAdminRequired
     * @NoCSRFRequired
     * @return JSONResponse
     */
    public function getInfo() {
        return new JSONResponse($this->fileModel->getAnalysisReport(10));
    }

}