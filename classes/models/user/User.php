<?php

namespace classes\models\user;

    class User {

        //Properties of the user
        public $firstName;
        public $email;
        public $password;

        //Creating a new user
        public function __construct($firstName, $email, $password) {  
            $this->firstName = $firstName;
            $this->email = $email;
            $this->password = $password;
        }

        //Return an array containing the user properties
        public function return() {
            $userAttr = [$this->firstName, $this->email, $this->password];
            return $userAttr;
        }

        //Store the user in the database.
        public function store() {
            $sql = "INSERT INTO users (first_name, email, password) VALUES (?,?,?)";

            $database = new \classes\Database();
            $pdo = $database->getPdo();

            $stmt = $pdo->prepare($sql);
            $stmt->bindParam(1, $this->firstName, \PDO::PARAM_STR);
            $stmt->bindParam(2, $this->email, \PDO::PARAM_STR);
            $stmt->bindParam(3, $this->password, \PDO::PARAM_STR);
            
            if (!$stmt->execute()) {
                return false;
            }

            return true;
        }

        //Check if the user exists and return their ID if the password matches the email.
        public static function authenticate($email, $password) {
            $database = new \classes\Database();
            $pdo = $database->getPdo();
            
            $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");

            $stmt->bindParam(1, $email, \PDO::PARAM_STR);

            
            if (!$stmt->execute()) {
                return "execute failed";
            }
            
            if (!$user = $stmt->fetch()) {
                return "fetch failed";
            }

            if(!password_verify($password, $user['password'])) {
                return "password failed";
            }
            //Be careful as to not make sure the uid is also 1 or 2, as this could end up causing the $result to turn as 1 or 2, which are 
            //reserved as errors. So I need to make sure to either reserve those rows in the sql database, or change the return $result to messages
            //rather than reserved numbers.

            //Use UUID's instead of incremental numbers instead. Makes for less conflicts overall.
            return $user['uid'];
        }

        //Return all users from the database
        public static function getAll() {
            $sql = "SELECT * FROM users";

            $database = new \classes\Database();
            $pdo = $database->getPdo();

            $stmt = $pdo->query($sql);
            $users = $stmt->fetchAll();

            return $users;
        }

        //Return a user object
        public static function getName($uid) {
            $database = new \classes\Database();
            $pdo = $database->getPdo();
            
            $stmt = $pdo->prepare("SELECT first_name FROM users WHERE uid = ?");
            $stmt->bindParam(1, $uid, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return false;
            }

            if (!$name = $stmt->fetch()) {
                return false;
            }

            return $name;
        }

        //Return the date of which the user was created at.
        public static function getCreatedAt($uid) {
            $database = new \classes\Database();
            $pdo = $database->getPdo();
            
            $stmt = $pdo->prepare("SELECT created_at FROM users WHERE uid = ?");
            $stmt->bindParam(1, $uid, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return false;
            }

            if (!$createdAt = $stmt->fetch()) {
                return false;
            }
            return $createdAt;
        }

        //Return whether or not the email is unique within the datbase.
        public static function isEmailUnique($email) {
            $database = new \classes\Database();
            $pdo = $database->getPdo();

            $stmt = $pdo->prepare("SELECT email FROM users WHERE email = ?");
            $stmt->bindParam(1, $email, \PDO::PARAM_STR);

            if (!$stmt->execute()) {
                return 0;
            }

            if (empty($stmt->fetch())) {
                return true;
            }

            return false;
        }
    }