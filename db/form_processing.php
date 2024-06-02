<?php
    require_once 'database.php';

    session_start();

    // Ak používateľ nie je prihlásený, presmeruje ho na prihlasovaciu stránku
    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit;
    }

    $databaza = new Database();
    $pdo = $databaza->getPdo();

    // Získanie ID prihláseného používateľa z relácie
    $user_id = $_SESSION['user_id'];

    // Skontrolovanie, či bol formulár odoslaný metódou POST
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $name = $_POST['name'];
        $ingredients = $_POST['ingredients'];
        $description = $_POST['description'];

        // SQL príkaz na vloženie nového receptu do databázy
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
