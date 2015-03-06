<?php

namespace App;

/**
 * Register the psr-4 auto loader. You will be able to use:
 * App\Controller, App\Model, App\Library, etc.
 */
(new \Ice\Loader())
    ->addNamespace(__NAMESPACE__, __DIR__)
    ->register();

// Create a dependency injector container
$di = new \Ice\Di();

// Set some services
$di->request = new \Ice\Http\Request();
$di->response = new \Ice\Http\Response();
$di->tag = new \Ice\Tag();

$di->set('dispatcher', function () {
    $dispatcher = new \Ice\Mvc\Dispatcher();
    $dispatcher->setNamespace(__NAMESPACE__);

    return $dispatcher;
});

$di->set('router', function () {
    $router = new \Ice\Mvc\Router();
    $router->setRoutes([
        // The universal routes
        [['GET', 'POST'], '/{controller:[a-z]+}/{action:[a-z]+}/{id:\d+}/{param}'],
        [['GET', 'POST'], '/{controller:[a-z]+}/{action:[a-z]+}/{id:\d+}'],
        [['GET', 'POST'], '/{controller:[a-z]+}/{action:[a-z]+}/{param}'],
        [['GET', 'POST'], '/{controller:[a-z]+}/{action:[a-z]+[/]?}'],
        [['GET', 'POST'], '/{controller:[a-z]+}/{id:\d+}'],
        [['GET', 'POST'], '/{controller:[a-z]+[/]?}'],
        [['GET', 'POST'], ''],
    ]);

    return $router;
});

$di->set('view', function () {
    $view = new \Ice\Mvc\View();
    $view->setViewsDir(__DIR__ . '/View/');

    return $view;
});

$di->set('db', function () {
    $driver = new \Ice\Db\Driver\Pdo('mysql:host=localhost;port=3306;dbname=demo_hello', 'demo', 'demo');
    
    return new \Ice\Db($driver);
});

// Create and return a MVC application
return new \Ice\Mvc\App($di);
