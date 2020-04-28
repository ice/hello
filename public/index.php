<?php

try {
    require_once __DIR__ . '/../root.php';

    // Load the bootstrap which return the MVC application
    $app = include_once __ROOT__ . '/App/Bootstrap.php';

    // Handle a MVC request and display the HTTP response body
    echo $app->handle();
} catch (Exception $e) {
    // Dispaly the excepton's message
    echo $e->getMessage();
}
