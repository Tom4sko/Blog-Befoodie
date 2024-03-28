<?php
$db_username = "root";
$db_password = "";
$db_name = "formular";
$db_host = "localhost";

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $sql = "SELECT meno, email, sprava FROM udaje";
    $stmt = $pdo->query($sql);

    echo '<section class="container">';
    echo '<div>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="blog-main dark-theme">';
        echo '<p class="blog-name">Meno: ' . $row['meno'] . '</p>';
        echo '<p class="blog-email">Email: ' . $row['email'] . '</p>';
        echo '<p>Správa: ' . $row['sprava'] . '</p>';
        echo '<button class="blog-button button-delete">Delete</button>';
        echo '<button class="blog-button button-reply">Reply</button>';
        echo '<br>';
        echo '<br>';
        echo '</div>';
    }
    echo '</div>';
    echo '</section>';

    $pdo = null;
} catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
    exit;
}
?>
