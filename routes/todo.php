<?php
$router->get('/todo', function() {
    require_once('controllers/todo/todo_view.php');
});

$router->post('/todo/add', function() {
    require_once('controllers/todo/todo_add.php');
});

$router->post('/todo/delete', function() {
    require_once('controllers/todo/todo_delete.php');
});
