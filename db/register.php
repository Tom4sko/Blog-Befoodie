<?php
    include 'database.php';

    $databaza = new Database();
    $pdo = $databaza->getPdo();

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['register-email'])) {
        $name = $_POST['register-name'];
        $email = $_POST['register-email'];
        $password = $_POST['register-password'];
        $passwordRe = $_POST['register-password-re'];
        $role = 'user';

        if ($password !== $passwordRe) {
            die('Passwords do not match.');
        }

        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare('INSERT INTO users (name, email, password, role) VALUES (?, ?, ?, ?)');
        $stmt->execute([$name, $email, $hashedPassword, $role]);

        header('Location: ../index.php');
        exit();
    }
?>
