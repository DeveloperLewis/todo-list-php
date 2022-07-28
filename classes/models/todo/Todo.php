<?php

namespace classes\models\todo;

    class Todo {

        //Properties of the todo list
        public $message;
        public $uid;
        public $status;

        //Creating the todo list
        public function __construct($message, $user, $status) {
            $this->message = $message;
            $this->uid = $user;
            $this->status = $status;
        }

        public function store() {
            $sql = "INSERT INTO todo (message, uid, status) VALUES (?,?,?)";

            $database = new \classes\Database();
            $pdo = $database->getPdo();
            
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $this->message, \PDO::PARAM_STR);
            $stmt->bindParam(2, $this->uid, \PDO::PARAM_STR);
            $stmt->bindParam(3, $this->status, \PDO::PARAM_STR);

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

        public static function updateStatus($message_id) {
            $database = new \classes\Database();
            $pdo = $database->getPdo();

            //Get the status from the message and assign to variable
            $sql = "SELECT status FROM todo WHERE message_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $message_id, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return false;
            }

            if (!$status = $stmt->fetch()) {
                return false;
            }

            if ($status['status'] == "completed") {
                $status['status'] = "in progress";
            }

            else if ($status['status'] == "in progress") {
                $status['status'] = "completed";
            }

            $sql = "UPDATE todo SET status = ? WHERE message_id = ?";

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $status['status'], \PDO::PARAM_STR);
            $stmt->bindParam(2, $message_id, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return false;
            }

            return true;
        }

        public static function getStatus($message_id) {
            $database = new \classes\Database();
            $pdo = $database->getPdo();

            //Get the status from the message and assign to variable
            $sql = "SELECT status FROM todo WHERE message_id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $message_id, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return false;
            }

            if (!$status = $stmt->fetch()) {
                return false;
            }

            return $status['message'];
        }
    }