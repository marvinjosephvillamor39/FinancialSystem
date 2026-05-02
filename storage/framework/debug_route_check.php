<?php
require __DIR__.'/../../vendor/autoload.php';
$app = require_once __DIR__.'/../../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
$router = $app->router;
$routes = $router->getRoutes();
foreach ($routes as $route) {
    echo $route->uri() . ' -> ' . implode(',', $route->methods()) . ' -> ' . $route->getName() . PHP_EOL;
}
