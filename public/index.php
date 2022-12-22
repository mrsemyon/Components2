<?php
require $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/../app/config.php';
session_start();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/home', ['App\Controllers\HomeController', 'index']);
    $r->addRoute(['GET', 'POST'], '/add', ['App\Controllers\HomeController', 'add']);
    $r->addRoute('GET', '/show/{id:\d+}', ['App\Controllers\HomeController', 'show']);
    $r->addRoute('GET', '/delete/{id:\d+}', ['App\Controllers\HomeController', 'delete']);
    $r->addRoute('GET', '/edit/{id:\d+}', ['App\Controllers\HomeController', 'edit']);
    $r->addRoute('GET', '/edit', ['App\Controllers\HomeController', 'edit']);
    $r->addRoute('POST', '/edit', ['App\Controllers\HomeController', 'edit']);
});

$httpMethod = $_SERVER['REQUEST_METHOD'];
$uri = $_SERVER['REQUEST_URI'];

if (false !== $pos = strpos($uri, '?')) {
    $uri = substr($uri, 0, $pos);
}
$uri = rawurldecode($uri);

$routeInfo = $dispatcher->dispatch($httpMethod, $uri);

switch ($routeInfo[0]) {
    case FastRoute\Dispatcher::NOT_FOUND:
        break;
    case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
        $allowedMethods = $routeInfo[1];
        break;
    case FastRoute\Dispatcher::FOUND:
        $handler = $routeInfo[1];
        $vars = $routeInfo[2];
        call_user_func([new $handler[0], $handler[1]], $vars);
        break;
}
