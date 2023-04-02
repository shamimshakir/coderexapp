<?php


use App\Controllers\HelloController;
use Core\Router;


$router = new Router;

$router->get('/hello/{id}/product/{product_id}/order', HelloController::class, 'index');
$router->post('/hello/{id}/product/{product_id}/order', HelloController::class, 'store');



return $router;