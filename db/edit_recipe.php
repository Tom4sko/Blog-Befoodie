<?php
require_once 'database.php';

class RecipeController {
    private $database;
    private $pdo;
    private $user_id;
    private $user_role;

    public function __construct() {
        $this->database = new Database();
        $this->pdo = $this->database->getPdo();
    }

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->startSession();
            $this->checkUserAuthentication();
            $this->user_id = $_SESSION['user_id'];
            $recipe_id = $_POST['recipe_id'];
            $this->user_role = $this->getUserRole();
            $recipe = $this->getRecipeById($recipe_id);
            if ($recipe) {
                if (isset($_POST['update_recipe'])) {
                    $this->updateRecipe($recipe_id);
                } else {
                    $this->displayEditRecipeForm($recipe);
                }
            } else {
                echo "Nemáte oprávnenie na úpravu tohto receptu.";
            }
        } else {
            header("Location: ../blog.php");
            exit;
        }
    }

    private function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    private function checkUserAuthentication() {
        if (!isset($_SESSION['user_id'])) {
            header("Location: ../login.php");
            exit;
        }
    }

    private function getUserRole() {
        $sql = "SELECT role FROM users WHERE id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$this->user_id]);
        return $stmt->fetchColumn();
    }

    private function getRecipeById($recipe_id) {
        $sql = "SELECT * FROM recipes WHERE id = ? AND (user_id = ? OR ? = 'admin')";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$recipe_id, $this->user_id, $this->user_role]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    private function updateRecipe($recipe_id) {
        $new_recipe_name = $_POST['new_recipe_name'];
        $new_recipe_ingredients = $_POST['new_recipe_ingredients'];
        $new_recipe_description = $_POST['new_recipe_description'];
        $sql_update = "UPDATE recipes SET name = ?, ingredients = ?, description = ? WHERE id = ?";
        $stmt_update = $this->pdo->prepare($sql_update);
        $stmt_update->execute([$new_recipe_name, $new_recipe_ingredients, $new_recipe_description, $recipe_id]);
        header("Location: ../blog.php");
        exit;
    }

    private function displayEditRecipeForm($recipe) {
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
}

$recipeController = new RecipeController();
$recipeController->handleRequest();
?>