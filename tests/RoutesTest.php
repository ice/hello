<?php

namespace Tests;

use PHPUnit_Framework_TestCase as PHPUnit;
use Ice\Di;
use Ice\Mvc\Router;
use App\Routes;

class RoutesTest extends PHPUnit
{

    private static $di;

    /**
     * Run public/index.php and fetch Di
     */
    public static function setUpBeforeClass()
    {
        $di = new Di();
        $di->set('router', function () {
            $router = new Router();
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
        
        self::$di = $di;
    }

    /**
     * Get service from Di
     */
    public function __get($service)
    {
        return self::$di->{$service};
    }

    /**
     * Test route matching for universal routes and GET method
     *
     * @dataProvider GETrouteProvider
     */
    public function testUniversalGET($pattern, $expected)
    {
        $return = $this->router->handle('GET', $pattern);

        $this->assertEquals('GET', $this->router->getMethod());

        if (is_array($return)) {
            $this->assertEquals($expected, [$this->router->getModule(), $this->router->getHandler(), $this->router->getAction(), $this->router->getParams()], $pattern);
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
        $return = $this->router->handle('POST', $pattern);

        $this->assertEquals('POST', $this->router->getMethod());

        if (is_array($return)) {
            $this->assertEquals($expected, [$this->router->getModule(), $this->router->getHandler(), $this->router->getAction(), $this->router->getParams()], $pattern);
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
