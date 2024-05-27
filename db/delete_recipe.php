<?php
    require 'database.php';
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $user_role = $_SESSION['user_role'];

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $recipe_id = $_POST['recipe_id'];

        // Načítanie receptu na kontrolu vlastníctva alebo rolí
        $sql = "SELECT * FROM recipes WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$recipe_id]);
        $recipe = $stmt->fetch();

        if ($recipe && ($user_role === 'admin' || $recipe['user_id'] == $user_id)) {
            // Ak je používateľ admin alebo vlastník receptu, môže ho zmazať
            $sql = "DELETE FROM recipes WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$recipe_id]);

            header("Location: ../blog.php?delete_success=1");
            exit;
        } else {
            // Ak nemá právo zmazať recept
            header("Location: ../blog.php?error=not_authorized");
            exit;
        }
    } else {
        header("Location: ../blog.php");
        exit;
    }
?>
