<?php

namespace App;

use Ice\Di\DiInterface;
use Ice\Mvc\ModuleInterface;

/**
 * Default module
 *
 * @package     Ice/Hello
 * @category    Module
 */
class Module implements ModuleInterface
{

    /**
     * Register a specific autoloader for the module
     *
     * @return void
     */
    public function registerAutoloaders()
    {
        
    }

    /**
     * Register specific services for the module
     *
     * @param object $di dependency Injector
     * @return void
     */
    public function registerServices(DiInterface $di)
    {
        
    }
}
