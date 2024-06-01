<?php

include_once 'session.php';
include_once 'database.php';

class UserRegistration {
    private $database;
    private $pdo;

    public function __construct() {
        $this->database = new Database();
        $this->pdo = $this->database->getPdo();
    }

    public function registerUser() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register-email'])) {
            $name = $_POST['register-name'];
            $email = $_POST['register-email'];
            $password = $_POST['register-password'];
            $passwordRe = $_POST['register-password-re'];
            $role = 'user';

            if ($password !== $passwordRe) {
                header('Location: registererror.php');
                exit();
            }

            $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $this->pdo->prepare('INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)');
            $stmt->execute([$name, $email, $hashedPassword, $role]);

            header('Location: registerlogin.php');
            exit();
        }
    }
}

$userRegistration = new UserRegistration();
$userRegistration->registerUser();
?>