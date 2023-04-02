<?php


use App\Controllers\HelloController;
use Core\Router;


$router = new Router;

$router->get('/hello', HelloController::class, 'index');



return $router;