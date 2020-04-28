<?php

namespace App;

// Create a dependency injector container
$di = new \Ice\Di();

// Register App namespace for App\Controller, App\Model, App\Library, etc.
$di->loader
    ->addNamespace(__NAMESPACE__, __DIR__)
    ->register();

// Set some service's settings
$di->dispatcher
    ->setNamespace(__NAMESPACE__);

// Use the fastroute
$di->set('router', new \Ice\Mvc\Fastrouter());

$di->view
    ->setViewsDir(__DIR__ . '/Views/');

$di->set('db', function () {
    $driver = new \Ice\Db\Driver\Pdo('mysql:host=localhost;port=3306;dbname=ice_hello', 'ice', 'ice');

    return new \Ice\Db($driver);
});

// Create and return a MVC application
return new \Ice\Mvc\App($di);
