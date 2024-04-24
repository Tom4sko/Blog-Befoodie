<?php
// Pripojenie k databáze
$servername = "localhost"; // Adresa servera
$username = "root"; // Užívateľské meno
$password = ""; // Heslo
$dbname = "formular"; // Názov databázy

// Vytvorenie pripojenia
$conn = new mysqli($servername, $username, $password);

// Overenie pripojenia
if ($conn->connect_error) {
    die("Pripojenie zlyhalo: " . $conn->connect_error);
}

// Vytvorenie databázy
$sql = "CREATE DATABASE IF NOT EXISTS $dbname";
if ($conn->query($sql) === TRUE) {
    echo "Databáza vytvorená úspešne\n";
} else {
    echo "Chyba pri vytváraní databázy: " . $conn->error . "\n";
}

// Pripojenie k vytvorenej databáze
$conn = new mysqli($servername, $username, $password, $dbname);

// Overenie pripojenia
if ($conn->connect_error) {
    die("Pripojenie zlyhalo: " . $conn->connect_error);
}

// Vytvorenie tabuľky
$sql = "CREATE TABLE IF NOT EXISTS udaje (
    ID INT AUTO_INCREMENT PRIMARY KEY,
    meno VARCHAR(50) NOT NULL,
    email VARCHAR(50) NOT NULL,
    sprava TEXT
)";

if ($conn->query($sql) === TRUE) {
    echo "Tabuľka udaje vytvorená úspešne\n";
} else {
    echo "Chyba pri vytváraní tabuľky: " . $conn->error . "\n";
}

// Zatvorenie pripojenia
$conn->close();
?>
