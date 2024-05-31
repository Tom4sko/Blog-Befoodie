<?php
class Database {
    private $host = '127.0.0.1';
    private $db = 'registerlogin';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    
    private $dsn;
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    private $pdo = null;

    public function __construct() {
        $this->dsn = "mysql:host={$this->host};charset={$this->charset}";
        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
            $this->initDatabase();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function getPdo() {
        return $this->pdo;
    }

    private function initDatabase() {
        $this->createDatabaseIfNotExists();
        $this->pdo->exec("USE `{$this->db}`");
        $this->createUsersTableIfNotExists();
        $this->createRecipesTableIfNotExists();
    }

    private function createDatabaseIfNotExists() {
        $stmt = $this->pdo->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :dbname");
        $stmt->execute(['dbname' => $this->db]);
        if ($stmt->rowCount() == 0) {
            $this->pdo->exec("CREATE DATABASE `{$this->db}`");
            echo "Database '{$this->db}' was created.<br>";
        }
    }

    private function createUsersTableIfNotExists() {
        $stmt = $this->pdo->prepare("SHOW TABLES LIKE 'users'");
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            $this->pdo->exec("CREATE TABLE `users` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `name` VARCHAR(100),
                `email` VARCHAR(100),
                `password` VARCHAR(255),
                `role` VARCHAR(50) NOT NULL DEFAULT 'user'
            )");
            echo "Table 'users' created.<br>";
        }
    }

    private function createRecipesTableIfNotExists() {
        $stmt = $this->pdo->prepare("SHOW TABLES LIKE 'recipes'");
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            $this->pdo->exec("CREATE TABLE `recipes` (
                `id` INT AUTO_INCREMENT PRIMARY KEY,
                `user_id` INT,
                `name` VARCHAR(45),
                `ingredients` VARCHAR(120),
                `description` TEXT
            )");
            echo "Table 'recipes' created.<br>";
        }
    }
}
?>
