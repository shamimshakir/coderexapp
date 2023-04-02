<?php


use Core\Application;


$dotenv = Dotenv\Dotenv::createImmutable(base_path('/'));
$dotenv->load();

$app = new Application;

$boot = require BASE_PATH . DIRECTORY_SEPARATOR . 'bootstrap/bindings.php';

$boot($app);

return $app;