<?php
class Database {
    private $host = '127.0.0.1';
    private $db = 'registerlogin';
    private $user = 'root';
    private $pass = '';
    private $charset = 'utf8mb4';
    
    private $dsn;
    
    private $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION, // Zapne výnimky pre chyby
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,       // Nastaví predvolený režim fetch na asociatívne pole
        PDO::ATTR_EMULATE_PREPARES   => false,                  // Vypne emuláciu prepared statements
    ];

    // Premenná pre PDO objekt
    private $pdo = null;

    public function __construct() {
        // Vytvorenie DSN reťazca
        $this->dsn = "mysql:host={$this->host};charset={$this->charset}";
        
        // Pokus o pripojenie k databáze pomocou PDO
        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->pass, $this->options);
            // Inicializácia databázy
            $this->initDatabase();
        } catch (\PDOException $e) {
            // Ak dôjde k chybe, vyhodí výnimku s chybovou správou a kódom
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    // Funkcia na získanie PDO objektu
    public function getPdo() {
        return $this->pdo;
    }

    private function initDatabase() {
        $this->createDatabaseIfNotExists();
        // Použitie databázy
        $this->pdo->exec("USE `{$this->db}`");
        $this->createUsersTableIfNotExists();
        $this->createRecipesTableIfNotExists();
    }

    // Privátna funkcia na vytvorenie databázy, ak neexistuje
    private function createDatabaseIfNotExists() {
        $stmt = $this->pdo->prepare("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = :dbname");
        $stmt->execute(['dbname' => $this->db]);
        if ($stmt->rowCount() == 0) {
            // Ak databáza neexistuje, vytvorí ju
            $this->pdo->exec("CREATE DATABASE `{$this->db}`");
            echo "Database '{$this->db}' was created.<br>";
        }
    }

    // Privátna funkcia na vytvorenie tabuľky 'users', ak neexistuje
    private function createUsersTableIfNotExists() {
        $stmt = $this->pdo->prepare("SHOW TABLES LIKE 'users'");
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            // Ak tabuľka neexistuje, vytvorí ju
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

    // Privátna funkcia na vytvorenie tabuľky 'recipes', ak neexistuje
    private function createRecipesTableIfNotExists() {
        $stmt = $this->pdo->prepare("SHOW TABLES LIKE 'recipes'");
        $stmt->execute();
        if ($stmt->rowCount() == 0) {
            // Ak tabuľka neexistuje, vytvorí ju
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
