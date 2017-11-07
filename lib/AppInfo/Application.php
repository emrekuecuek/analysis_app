<?php
namespace OCA\Analysis_app\AppInfo;
use \OCP\AppFramework\App;
use OCP\IContainer;

class Application extends App {
    //Define your dependencies here
    public function __construct(array $urlParams = array()) {
        parent::__construct('analysis_app', $urlParams);
        $container = $this->getContainer();


    }
}