<?php

namespace App;

/**
 * Register the psr-4 auto loader. You will be able to use:
 * App\Controller, App\Model, App\Library, etc.
 */
(new \Ice\Loader())
    ->addNamespace(__NAMESPACE__, __DIR__)
    ->register();

// Load universal routes
$routes = require_once __DIR__ . '/routes.php';

// Create a dependency injector container
$di = new \Ice\Di();

// Set some services
$di->request = new \Ice\Http\Request();
$di->response = new \Ice\Http\Response();
$di->dispatcher = new \Ice\Mvc\Dispatcher();

$di->set('router', function () use ($routes) {
    $router = new \Ice\Mvc\Router();
    $router->setRoutes($routes);

    return $router;
});

$di->set('view', function () {
    $view = new \Ice\Mvc\View();
    $view->setViewsDir(__DIR__ . '/View/');

    return $view;
});

// Create and return a MVC application
return new \Ice\Mvc\App($di);
