<?php

require_once __DIR__ . '/vendor/autoload.php';



$app = new Silex\Application();


require __DIR__ . '/resources/config/prod.php';

$ip = $app['db.options']['host'] ;

exec("ping -c 1 $ip", $output, $status);

if($status != 0)
{
    require __DIR__ . '/resources/config/dev.php';
}

require __DIR__ . '/src/App.php';

$app['http_cache']->run();