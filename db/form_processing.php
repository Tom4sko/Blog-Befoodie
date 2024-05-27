<?php
    require 'database.php';

    session_start();
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $ingredients = $_POST['ingredients'];
        $description = $_POST['description'];

        $sql = "INSERT INTO recipes (name, ingredients, description, user_id) VALUES (?, ?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        
        if ($stmt->execute([$name, $ingredients, $description, $user_id])) {
            header("Location: ../blog.php?success=1");
            exit;
        } else {
            header("Location: ../blog.php?error=1");
            exit;
        }
    }
?>
