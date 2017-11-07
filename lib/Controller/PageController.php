<?php
/**
 * Created by PhpStorm.
 * User: kucuk
 * Date: 27.10.2017
 * Time: 21:06
 */
namespace OCA\Analysis_app\Controller;
use OCP\AppFramework\Controller;
use OCP\AppFramework\Http\TemplateResponse;

class PageController extends Controller {

    public function index() {
        $templateResponse = new TemplateResponse($this->appName, 'index', []);

        return $templateResponse;
    }
}
