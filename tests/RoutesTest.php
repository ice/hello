<?php

namespace Tests;

use PHPUnit_Framework_TestCase as PHPUnit;
use Ice\Di;
use Ice\Mvc\Router;
use App\Routes;

class RoutesTest extends PHPUnit
{

    /**
     * Test route matching for universal routes and GET method
     *
     * @dataProvider GETrouteProvider
     */
    public function testUniversalGET($pattern, $expected)
    {
        $di = new Di();
        $router = new Router();
        $routes = require __DIR__ . '/../App/routes.php';
        $router->setRoutes($routes);
        $return = $router->handle('GET', $pattern);

        $this->assertEquals('GET', $router->getMethod());

        if (is_array($return)) {
            $this->assertEquals($expected, [$router->getModule(), $router->getHandler(), $router->getAction(), $router->getParams()], $pattern);
        } else {
            $this->assertEquals($expected, null, "The route wasn't matched by any route");
        }
    }

    /**
     * Test route matching for universal routes and POST method
     *
     * @dataProvider POSTrouteProvider
     */
    public function testUniversalPOST($pattern, $expected)
    {
        $di = new Di();
        $router = new Router();
        $routes = require __DIR__ . '/../App/routes.php';
        $router->setRoutes($routes);
        $return = $router->handle('POST', $pattern);

        $this->assertEquals('POST', $router->getMethod());

        if (is_array($return)) {
            $this->assertEquals($expected, [$router->getModule(), $router->getHandler(), $router->getAction(), $router->getParams()], $pattern);
        } else {
            $this->assertEquals($expected, null, "The route wasn't matched by any route");
        }
    }

    /**
     * Routes provider for GET method
     * [pattern, expected route: [module, handler, action, [params]]]
     *
     * @return array
     */
    public function GETrouteProvider()
    {
        return [
            ['', ['default', 'index', 'index', []]],
            ['/index', ['default', 'index', 'index', []]],
            ['/index/index', ['default', 'index', 'index', []]],
            ['/index/test', ['default', 'index', 'test', []]],
            ['/user', ['default', 'user', 'index', []]],
            ['/user/', ['default', 'user', 'index', []]],
            ['/user/3', ['default', 'user', 'index', ['id' => 3]]],
            ['/user/signup', ['default', 'user', 'signup', []]],
            ['/user/profile/1', ['default', 'user', 'profile', ['id' => 1]]],
            ['/user/profile/ice', ['default', 'user', 'profile', ['param' => 'ice']]],
            ['/post/details/7/friendly-title', ['default', 'post', 'details', ['id' => 7, 'param' => 'friendly-title']]],
        ];
    }

    /**
     * Routes provider for POST method
     * [pattern, expected route: [module, handler, action, [params]]]
     *
     * @return array
     */
    public function POSTrouteProvider()
    {
        return [
            ['', ['default', 'index', 'index', []]],
            ['/index', ['default', 'index', 'index', []]],
            ['/index/index', ['default', 'index', 'index', []]],
            ['/index/test', ['default', 'index', 'test', []]],
            ['/user', ['default', 'user', 'index', []]],
            ['/user/', ['default', 'user', 'index', []]],
            ['/user/3', ['default', 'user', 'index', ['id' => 3]]],
            ['/user/signup', ['default', 'user', 'signup', []]],
            ['/user/profile/1', ['default', 'user', 'profile', ['id' => 1]]],
            ['/user/profile/ice', ['default', 'user', 'profile', ['param' => 'ice']]],
            ['/post/details/7/friendly-title', ['default', 'post', 'details', ['id' => 7, 'param' => 'friendly-title']]],
        ];
    }

}
