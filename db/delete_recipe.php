<?php
require_once 'database.php';

$databaza = new Database();
$pdo = $databaza->getPdo();

class RecipeController {
    private $database;
    private $user_id;
    private $user_role;

    public function __construct() {
        $this->database = new Database();
        $this->startSession();
        $this->checkUserAuthentication();
        $this->user_id = $_SESSION['user_id'];
        $this->user_role = $_SESSION['user_role'];
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

    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recipe_id = $_POST['recipe_id'];
            $recipe = $this->getRecipeById($recipe_id);

            if ($recipe && ($this->user_role === 'admin' || $recipe['user_id'] == $this->user_id)) {
                $this->deleteRecipe($recipe_id);
                header("Location: ../blog.php?delete_success=1");
                exit;
            } else {
                header("Location: ../blog.php?error=not_authorized");
                exit;
            }
        } else {
            header("Location: ../blog.php");
            exit;
        }
    }

    private function getRecipeById($recipe_id) {
        $pdo = $this->database->getPdo();
        $sql = "SELECT * FROM recipes WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$recipe_id]);
        return $stmt->fetch();
    }

    private function deleteRecipe($recipe_id) {
        $pdo = $this->database->getPdo();
        $sql = "DELETE FROM recipes WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$recipe_id]);
    }
}

$recipeController = new RecipeController();
$recipeController->handleRequest();
?>