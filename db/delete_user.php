<?php
    require_once "database.php";

    $databaza = new Database();
    $pdo = $databaza->getPdo();

    // Kontrola, či je v URL adrese poskytnutý parameter 'id'
    if (isset($_GET['id'])) {
        $id = $_GET['id'];

        try {
            $sql = "DELETE FROM users WHERE id = ?";
            $stmt = $pdo->prepare($sql);

            // Vykonanie SQL príkazu s poskytnutým ID ako parametrom
            if ($stmt->execute([$id])) {
                header("Location: ../dashboard.php");
                exit();
            } else {
                echo "Nepodarilo sa vymazať používateľa.";
            }
        } catch (PDOException $e) {
            echo "Chyba: " . $e->getMessage();
        }
    } else {
        // Vypísanie chybovej správy, ak nie je poskytnutý parameter 'id'
        echo "ID nebol poskytnutý";
        exit();
    }
?>
