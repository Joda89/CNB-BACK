<?php
$app['log.level'] = Monolog\Logger::ERROR;
$app['api.version'] = "v1";
$app['api.endpoint'] = "/api";
$app['db.options'] = array(
  "driver" => "pdo_mysql",
  "user" => "cnb",
  "password" => "0rfi8fxlgMaGsruV",
  "dbname" => "cnb",
  "host" => "mysql-cnb",
);
