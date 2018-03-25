<?php
$app['log.level'] = Monolog\Logger::ERROR;
$app['api.version'] = "v1";
$app['api.endpoint'] = "/api";
$app['db.options'] = array(
  "driver" => "pdo_mysql",
  "user" => getenv(DATABASE_USER),
  "password" => getenv(DATABASE_PASSWORD),
  "dbname" => getenv(DATABASE_NAME),
  "host" => getenv(MARIADB_HOST).":".getenv(MARIADB_PORT_NUMBER),
);
