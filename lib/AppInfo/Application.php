<?php
namespace OCA\Analysis_app\AppInfo;
use OCA\Analysis_app\Controller\PageController;
use OCA\Analysis_app\FileModel;
use \OCP\AppFramework\App;

class Application extends App {
	//Define your dependencies here
	public function __construct(array $urlParams = array()) {
		parent::__construct('analysis_app', $urlParams);
		$container = $this->getContainer();

		$container->registerService('FileModel', function($c) {
			return new FileModel(
				$c->query('ServerContainer')->getUserFolder()
			);
		});

		$container->registerService('PageController', function($c) {
			return new PageController(
				$c->query('AppName'),
				$c->query('Request'),
				$c->query('FileModel')
			);
		});
	}
}