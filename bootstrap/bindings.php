<?php

use Core\Application;
use Core\Container;

return function (Application $app) {
    $app->setContainer(new Container);
    $app->bind([
        'config' => fn () => 'bonk'
    ]);
};