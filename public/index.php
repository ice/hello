<?php

defined('__ROOT__') or
    /**
     * Full path to the docroot
     */
    define('__ROOT__', dirname(__DIR__));

try {
    // Load the bootstrap which return the MVC application
    $app = require_once __ROOT__ . '/App/Bootstrap.php';

    // Handle a MVC request and display the HTTP response body
    echo $app->handle();
} catch (Exception $e) {
    // Dispaly the excepton's message
    echo $e->getMessage();
}
