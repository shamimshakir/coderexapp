<?php


use Core\Application;



$app = new Application;

$boot = require BASE_PATH . DIRECTORY_SEPARATOR . 'bootstrap/bindings.php';

$boot($app);

return $app;