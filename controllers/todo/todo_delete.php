<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('Location: /');
    die();
}

$message_id = $_POST['messageid'];

$result = \classes\models\todo\Todo::delete($message_id);

if ($result == false) {
    session_start();
    $_SESSION['error'] = "There was an error deleting the message, please try again.";

    header('Location: /todo');
    die();
}

header('Location: /todo');
die();