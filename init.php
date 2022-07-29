<?php
function init() {

    //Database connection configuration here
    $host = "localhost";

    $username = "root";
    $password = "";

    try {
        $pdo = new PDO("mysql:host=$host", $username, $password);
    }
    catch (PDOException $e) {
        die("DB ERROR: " . $e->getMessage());
    }


    //Check if the database already exists, if so don't create anything new.
    $sql = "SHOW DATABASES LIKE 'todo'";
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    $database = $stmt->fetch();
    if (!empty($database)) {
        return false;
    }


    //Database schema creation
    $sql = "CREATE DATABASE IF NOT EXISTS todo;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "USE todo";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "CREATE TABLE IF NOT EXISTS `users` ( 
        `uid` int(11) NOT NULL,
        `first_name` varchar(30) NOT NULL,
        `email` varchar(320) NOT NULL,
        `password` varchar(128) NOT NULL,
        `created_at` timestamp NOT NULL DEFAULT current_timestamp()
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "CREATE TABLE IF NOT EXISTS `todo` (
        `message_id` int(11) NOT NULL,
        `uid` int(11) NOT NULL,
        `message` varchar(1500) NOT NULL,
        `status` varchar(15) NOT NULL
      ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `users`
            ADD PRIMARY KEY (`uid`);";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `users` 
            MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `todo`
            ADD PRIMARY KEY (`message_id`);";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }

    $sql = "ALTER TABLE `todo` 
            MODIFY `message_id` int(11) NOT NULL AUTO_INCREMENT;";
    $stmt = $pdo->prepare($sql);
    if (!$stmt->execute()) {
        return false;
    }
}

init();

//Self destruct, never to be seen again.
unlink("init.php");