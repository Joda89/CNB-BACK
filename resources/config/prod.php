<?php
$app['log.level'] = Monolog\Logger::ERROR;
$app['api.version'] = "v1";
$app['api.endpoint'] = "/api";
$app['db.options'] = array(
  "driver" => "pdo_mysql",
  "user" => "userLAB",
  "password" => "kRBJNPreArG1hlNs",
  "dbname" => "cnb",
  "host" => "10.1.0.7",
);
