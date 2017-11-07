<?php

namespace OCP\AppFramework\App;
use OC\Core\Application;
$app = new Application();



\OC::$server->getNavigationManager()->add(function () {
    $urlGenerator = \OC::$server->getURLGenerator();
    return [
        'id' => 'analysis_app',
        'order' => 10,
        'href' => $urlGenerator->linkToRoute('analysis_app.page.index'),
        'icon' => $urlGenerator->imagePath('analysis_app', 'app.svg'),
        'name' => \OC::$server->getL10N('analysis_app')->t('Analiz'),
    ];
});
