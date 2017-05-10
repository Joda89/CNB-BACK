<?php

require_once __DIR__ . '/vendor/autoload.php';



$app = new Silex\Application();

echo getenv("ENV") ;

//if(getenv("ENV") == 'prod') {
    require __DIR__ . '/resources/config/prod.php';
//} else {
//    require __DIR__ . '/resources/config/dev.php';
//}

require __DIR__ . '/src/App.php';

$app['http_cache']->run();