<?php

//Autoloading classes to create a router object.
require_once('vendor/autoload.php');
$router = new classes\Router();


//Standard & Basic routing
$router->get('/', function() {
    session_start();
    require_once('views/index.php');
});

$router->notFound(function() {
    require_once('views/404.php');
});

//User routes
require_once('routes/user.php');
require_once('routes/todo.php');

$router->run();
