<?php
require_once 'database.php';

$databaza = new Database();
$pdo = $databaza->getPdo();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();

    if (!isset($_SESSION['user_id'])) {
        header("Location: ../login.php");
        exit;
    }

    $user_id = $_SESSION['user_id'];
    $recipe_id = $_POST['recipe_id'];

    // Získame rolu používateľa z databázy
    $sql = "SELECT role FROM users WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$user_id]);
    $user_role = $stmt->fetchColumn();

    // Overíme, či je používateľ vlastníkom receptu alebo administrátorom
    $sql = "SELECT * FROM recipes WHERE id = ? AND (user_id = ? OR ? = 'admin')";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$recipe_id, $user_id, $user_role]);
    $recipe = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($recipe) {
        // Tu môžete pridať kód pre úpravu receptu
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_recipe'])) {
            $new_recipe_name = $_POST['new_recipe_name'];
            $new_recipe_ingredients = $_POST['new_recipe_ingredients'];
            $new_recipe_description = $_POST['new_recipe_description'];

            // Aktualizujeme recept v databáze
            $sql_update = "UPDATE recipes SET name = ?, ingredients = ?, description = ? WHERE id = ?";
            $stmt_update = $pdo->prepare($sql_update);
            $stmt_update->execute([$new_recipe_name, $new_recipe_ingredients, $new_recipe_description, $recipe_id]);

            // Presmerujeme späť na blog.php po úspešnej aktualizácii
            header("Location: ../blog.php");
            exit;
        } else {
            ?>
            <!DOCTYPE html>
            <html lang="en">
            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <link rel="stylesheet" href="../css/style.css">
                <title>Edit Recipe</title>
            </head>
            <body class="edit-recipe-body">
                <div class="edit-recipe-container">
                    <h2 class="edit-recipe-label">Change Your Post</h2>
                    <form action="" method="POST" class="edit-recipe-form">
                        <input type="hidden" name="recipe_id" value="<?php echo htmlspecialchars($recipe['id']); ?>">
                        <label for="new-recipe-name" class="edit-recipe-label">New Recipe Name:</label>
                        <input type="text" id="new-recipe-name" name="new_recipe_name" class="edit-recipe-input" value="<?php echo htmlspecialchars($recipe['name']); ?>" required>

                        <label for="new-recipe-ingredients" class="edit-recipe-label">New Ingredients:</label>
                        <textarea id="new-recipe-ingredients" name="new_recipe_ingredients" class="edit-recipe-textarea" required><?php echo htmlspecialchars($recipe['ingredients']); ?></textarea>

                        <label for="new-recipe-description" class="edit-recipe-label">New Description:</label>
                        <textarea id="new-recipe-description" name="new_recipe_description" class="edit-recipe-textarea" required><?php echo htmlspecialchars($recipe['description']); ?></textarea>

                        <input type="submit" name="update_recipe" value="Save" class="edit-recipe-submit">
                    </form>
                </div>
            </body>
            </html>
            <?php
        }
    } else {
        echo "Nemáte oprávnenie na úpravu tohto receptu.";
    }
} else {
    header("Location: ../blog.php");
    exit;
}
?>
