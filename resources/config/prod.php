<?php
$app['log.level'] = Monolog\Logger::ERROR;
$app['api.version'] = "v1";
$app['api.endpoint'] = "/api";
$app['db.options'] = array(
  "driver" => "pdo_mysql",
  "user" => "cnb",
  "password" => "N0iwKY8qBRH8bVVF",
  "dbname" => "cnb",
  "host" => "mariadb",
);
