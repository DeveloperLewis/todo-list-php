<?php

namespace classes\models\todo;

    class Todo {

        //Properties of the todo list
        public $message;
        public $uid;

        //Creating the todo list
        public function __construct($message, $user) {
            $this->message = $message;
            $this->uid = $user;
        }

        public function store() {
            $sql = "INSERT INTO todo (message, uid) VALUES (?,?)";

            $database = new \classes\Database();
            $pdo = $database->getPdo();
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $this->message, \PDO::PARAM_STR);
            $stmt->bindParam(2, $this->uid, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return false;
            }
            return true;
        }

        public static function getAll($uid) {
            $sql = "SELECT * FROM todo WHERE uid = ?";

            $database = new \classes\Database();
            $pdo = $database->getPdo();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $uid, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return "execute failed";
            }

            if (!$todos = $stmt->fetchAll()) {
                return "fetch failed";
            }

            return $todos;
        }

        public static function delete($message_id) {
            $sql = "DELETE FROM todo where message_id = ?";

            $database = new \classes\Database();
            $pdo = $database->getPdo();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $message_id, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return false;
            }

            return true;
        }
    }