<?php
if (empty($_POST['messageid'])) {
    session_start();
    $_SESSION['error'] = "There was an error updating the status of the message, please try again.";

    header('Location: /todo');
    die();
}



$result = \classes\models\todo\Todo::updateStatus($_POST['messageid']);

if ($result == false) {
    session_start();
    $_SESSION['error'] = "There was an error updating the status of the message, please try again.";

    header('Location: /todo');
    die();
} 

header('Location: /todo');
    die();