<?php
    include_once 'session.php';
    include_once 'database.php';

    class UserRegistration {
        private $database;
        private $pdo;

        // Konštruktor na inicializáciu pripojenia k databáze
        public function __construct() {
            $this->database = new Database();
            $this->pdo = $this->database->getPdo();
        }

        public function registerUser() {
            // Skontrolovanie, či bol formulár odoslaný metódou POST a či je nastavené pole s emailom
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register-email'])) {
                $name = $_POST['register-name'];
                $email = $_POST['register-email'];
                $password = $_POST['register-password'];
                $passwordRe = $_POST['register-password-re'];
                $role = 'user';

                // Skontrolovanie, či sa heslá zhodujú
                if ($password !== $passwordRe) {
                    header('Location: registererror.php');
                    exit();
                }

                // Zašifrovanie hesla pre bezpečnosť
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                // Príprava SQL príkazu na vloženie nového používateľa do databázy
                $stmt = $this->pdo->prepare('INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)');
                // Vykonanie príkazu s údajmi poskytnutými používateľom
                $stmt->execute([$name, $email, $hashedPassword, $role]);

                header('Location: registerlogin.php');
                exit();
            }
        }
    }

    // Vytvorenie inštancie triedy UserRegistration a volanie metódy registerUser
    $userRegistration = new UserRegistration();
    $userRegistration->registerUser();
?>
