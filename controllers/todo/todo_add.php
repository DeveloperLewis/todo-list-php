<?php
session_start();
if (!isset($_SESSION['uid'])) {
    header('Location: /');
    die();
}



$message = $_POST['message'];
$user = $_SESSION['uid'];
$errors = [];

if (!isset($message) || empty($message)) {
    $errors['empty'] = "Todo message cannot be empty.";
};

if (strlen($message) < 1) {
    $errors['min_size'] = "Todo message must be greater than 1 character.";
};

if (strlen($message) > 500) {
    $errors['max_size'] = "Todo message must be less than 500 characters.";
};

if (preg_match('/[^A-Za-z0-9 ]/', $message)) {
    $errors['special_characters'] = "Todo message cannot contain any special characters. Letters, numbers and spaces only.";
};

if (!empty($errors)) {
    session_start();
    $_SESSION['errors'] = $errors;

    header('Location: /todo');
    die();
}
$todo = new \classes\models\todo\Todo($message, $user);

if ($todo->store() == false) {
    session_start();
    $_SESSION['error'] = "There was an error adding the message, please try again.";

    header('Location: /todo');
    die();
};

header('Location: /todo');
die();

