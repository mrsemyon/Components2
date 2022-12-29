<?php
require $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
require $_SERVER['DOCUMENT_ROOT'] . '/../app/config.php';
session_start();

use League\Plates\Engine;
use Delight\Auth\Auth;
use App\Classes\Database;
use Aura\SqlQuery\QueryFactory;
use \DI\ContainerBuilder;

$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions([
    Engine::class => function() {
        return new Engine('../app/views');
    },
    Auth::class => function() {
        return new Auth(Database::getInstance());
    },
    QueryFactory::class => function() {
        return new QueryFactory('mysql');
    },
    PDO::class => function() {
        return Database::getInstance();
    }
]);
$container = $containerBuilder->build();

$dispatcher = FastRoute\simpleDispatcher(function (FastRoute\RouteCollector $r) {
    $r->addRoute('GET', '/home', ['App\Controllers\HomeController', 'index']);
    $r->addRoute(['GET', 'POST'], '/add', ['App\Controllers\HomeController', 'add']);
    $r->addRoute('GET', '/show/{id:\d+}', ['App\Controllers\HomeController', 'show']);
    $r->addRoute('GET', '/delete/{id:\d+}', ['App\Controllers\HomeController', 'delete']);
    $r->addRoute('GET', '/edit/{id:\d+}', ['App\Controllers\HomeController', 'edit']);
    $r->addRoute('GET', '/edit', ['App\Controllers\HomeController', 'edit']);
    $r->addRoute('POST', '/edit', ['App\Controllers\HomeController', 'edit']);
    $r->addRoute(['GET', 'POST'], '/register', ['App\Controllers\HomeController', 'register']);
    $r->addRoute(['GET', 'POST'], '/login', ['App\Controllers\HomeController', 'login']);
    $r->addRoute('GET', '/logout', ['App\Controllers\HomeController', 'logout']);
    $r->addRoute('GET', '/mail', ['App\Controllers\HomeController', 'mail']);
    $r->addRoute('GET', '/faker', ['App\Controllers\HomeController', 'faker']);
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
        $container->call($routeInfo[1], $routeInfo[2]);
        break;
}
