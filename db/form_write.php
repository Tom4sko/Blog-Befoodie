<?php
// Pripojenie k databáze
require_once 'database.php';

// SQL dotaz na získanie údajov o receptoch s menami používateľov
$sql = "SELECT recipes.*, users.name AS user_name FROM recipes LEFT JOIN users ON recipes.user_id = users.id";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$recipes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Zobrazenie údajov o receptoch
foreach ($recipes as $recipe) {
    echo "<div class='recipe'>";
    echo "<h3>" . htmlspecialchars($recipe['user_name']) . " - " . htmlspecialchars($recipe['name']) . "</h3>";
    echo "<p><strong>Ingrediencie:</strong> " . htmlspecialchars($recipe['ingredients']) . "</p>";
    echo "<p><strong>Popis:</strong> " . htmlspecialchars($recipe['description']) . "</p>";
    echo "</div>";
}
?>
