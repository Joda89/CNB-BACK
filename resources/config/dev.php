<?php
require __DIR__ . '/prod.php';
$app['debug'] = true;
$app['log.level'] = Monolog\Logger::ERROR;
$app['db.options'] = array(
  "driver" => "pdo_mysql",
  "user" => "cnb",
  "password" => "cnb",
  "dbname" => "cnb",
  "host" => "localhost:8889",
);
