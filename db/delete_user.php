<?php
    require "database.php";

    $databaza = new Database();
    $pdo = $databaza->getPdo();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        try {
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $pdo->prepare($sql);
            if ($stmt->execute([$id])) {
                header("Location: ../dashboard.php");
                exit();
            } else {
                echo "Failed to delete user.";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "ID not provided";
        exit();
    }
?>
