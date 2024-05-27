<?php
    $host = '127.0.0.1';
    $db = 'registerlogin';
    $user = 'root';
    $pass = '';
    $charset = 'utf8mb4';

    $dsn = "mysql:host=$host;charset=$charset";
    $options = [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES   => false,
    ];

    try {
        $pdo = new PDO($dsn, $user, $pass, $options);
    } catch (\PDOException $e) {
        throw new \PDOException($e->getMessage(), (int)$e->getCode());
    }

    $stmt = $pdo->query("SELECT SCHEMA_NAME FROM INFORMATION_SCHEMA.SCHEMATA WHERE SCHEMA_NAME = '$db'");
    if ($stmt->rowCount() == 0) {
        $pdo->query("CREATE DATABASE $db");
        echo "Database '$db' was created.<br>";
    }

    $pdo->query("USE $db");

    $stmt = $pdo->query("SHOW TABLES LIKE 'users'");
    if ($stmt->rowCount() == 0) {
        $pdo->query("CREATE TABLE users (
            id INT AUTO_INCREMENT PRIMARY KEY,
            name VARCHAR(100),
            email VARCHAR(100),
            password VARCHAR(255),
            role VARCHAR(50) NOT NULL DEFAULT 'user'
        )");
        echo "Table 'users' created.<br>";
    }

    $stmt = $pdo->query("SHOW TABLES LIKE 'recipes'");
    if ($stmt->rowCount() == 0) {
        $pdo->query("CREATE TABLE recipes (
            id INT AUTO_INCREMENT PRIMARY KEY,
            user_id INT,
            name VARCHAR(45),
            ingredients VARCHAR(120),
            description TEXT
        )");
        echo "Table 'recipes' created.<br>";
    }
?>
