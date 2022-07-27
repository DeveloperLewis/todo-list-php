<?php

session_start();
if (!isset($_SESSION['uid'])) {
    header('Location: /');
    die();
}
$todos = \classes\models\todo\Todo::getAll($_SESSION['uid']);
require_once('views/todo/view.php');