<?php

return [
    // Universal routes for GET request
    ['GET', '/{controller:[a-z]+}/{action:[a-z]+}/{id:\d+}'],
    ['GET', '/{controller:[a-z]+}/{action:[a-z]+}/{param}'],
    ['GET', '/{controller:[a-z]+}/{action:[a-z]+[/]?}'],
    ['GET', '/{controller:[a-z]+}/{id:\d+}'],
    ['GET', '/{controller:[a-z]+[/]?}'],
    ['GET', ''],
    // Universal routes for POST request
    ['POST', '/{controller:[a-z]+}/{action:[a-z]+}/{id:\d+}'],
    ['POST', '/{controller:[a-z]+}/{action:[a-z]+}/{param}'],
    ['POST', '/{controller:[a-z]+}/{action:[a-z]+[/]?}'],
    ['POST', '/{controller:[a-z]+}/{id:\d+}'],
    ['POST', '/{controller:[a-z]+[/]?}'],
];
