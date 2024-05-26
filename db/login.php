<?php
include 'database.php';

session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login-email'])) {
    $email = $_POST['login-email'];
    $password = $_POST['login-password'];

    $stmt = $pdo->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        $_SESSION['user_role'] = $user['role'];
        echo 'Login successful!';
        header('Location: ../index.php');
        exit;
    } else {
        echo 'Invalid email or password.';
    }
}
?>
