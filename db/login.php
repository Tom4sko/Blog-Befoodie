<?php
    include_once 'session.php';
    include_once 'database.php';

    class User {
        private $pdo;

        public function __construct($pdo) {
            $this->pdo = $pdo;
        }

        public function login($email, $password) {
            // Príprava SQL príkazu na vyhľadanie používateľa podľa emailu
            $stmt = $this->pdo->prepare('SELECT * FROM users WHERE email = ?');
            $stmt->execute([$email]);
            $user = $stmt->fetch();

            // Skontrolovanie, či používateľ existuje a či je heslo správne
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

    // Skontrolovanie, či bol formulár odoslaný metódou POST a či je nastavené pole s emailom
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login-email'])) {
        $email = $_POST['login-email'];
        $password = $_POST['login-password'];

        // Pokus o prihlásenie používateľa
        $loginResult = $user->login($email, $password);

        // Presmerovanie podľa výsledku prihlásenia
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
