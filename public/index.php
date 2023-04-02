<?php

use Core\Application;

define('BASE_PATH', dirname(__DIR__));
define('APP_START_TIME', microtime(true));

require __DIR__.'/../vendor/autoload.php';

$app = require_once __DIR__.'/../bootstrap/app.php';

/** @var Application $app */
$app->start($_SERVER)
    ->capture($_REQUEST)
    ->serve();