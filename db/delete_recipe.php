<?php
require_once 'database.php';

// Vytvorenie novej inštancie databázy a získanie PDO spojenia
$databaza = new Database();
$pdo = $databaza->getPdo();

class RecipeController {
    private $database;
    private $user_id;
    private $user_role;

    public function __construct() {
        // Inicializácia databázy, spustenie session a overenie užívateľa
        $this->database = new Database();
        $this->startSession();
        $this->checkUserAuthentication();
        $this->user_id = $_SESSION['user_id'];
        $this->user_role = $_SESSION['user_role'];
    }

    // Funkcia na spustenie session
    private function startSession() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Funkcia na overenie, či je užívateľ prihlásený
    private function checkUserAuthentication() {
        if (!isset($_SESSION['user_id'])) {
            // Ak nie je prihlásený, presmeruj na login stránku
            header("Location: ../login.php");
            exit;
        }
    }

    // Funkcia na spracovanie požiadaviek
    public function handleRequest() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $recipe_id = $_POST['recipe_id'];
            $recipe = $this->getRecipeById($recipe_id);

            // Kontrola oprávnení užívateľa
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

    // Funkcia na získanie receptu podľa ID
    private function getRecipeById($recipe_id) {
        $pdo = $this->database->getPdo();
        $sql = "SELECT * FROM recipes WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$recipe_id]);
        return $stmt->fetch();
    }

    // Funkcia na zmazanie receptu podľa ID
    private function deleteRecipe($recipe_id) {
        $pdo = $this->database->getPdo();
        $sql = "DELETE FROM recipes WHERE id = ?";
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$recipe_id]);
    }
}

// Vytvorenie inštancie RecipeController a spracovanie požiadavku
$recipeController = new RecipeController();
$recipeController->handleRequest();
?>
