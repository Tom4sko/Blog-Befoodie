<?php
include_once 'session.php';
include_once 'database.php';
class User {
    private $pdo;
    public function __construct($pdo) {
        $this->pdo = $pdo;
    }
    public function login($email, $password) {
        $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        if ($user) {
            if (password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['name'];
                $_SESSION['user_role'] = $user['role'];
                return true;
            } else {
                return "invalid_password";
            }
        } else {
            return "invalid_email";
        }
    }
    public function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }
    public function getUserId() {
        return $_SESSION['user_id'];
    }
    public function getUserName() {
        return $_SESSION['user_name'];
    }
    public function getUserRole() {
        return $_SESSION['user_role'];
    }
    public function logout() {
        session_unset();
        session_destroy();
    }
}
$databaza = new Database();
$pdo = $databaza->getPdo();
$user = new User($pdo);
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login-email'])) {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];
    $loginResult = $user->login($email, $password);
    if ($loginResult === true) {
        header('Location: index.php');
        exit;
    } elseif ($loginResult === "invalid_email") {
        header('Location: loginemailerror.php');
        exit;
    } elseif ($loginResult === "invalid_password") {
        header('Location: loginpassworderror.php');
        exit;
    }
}
?>