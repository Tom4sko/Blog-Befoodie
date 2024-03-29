<?php
$db_username = "root";
$db_password = "";
$db_name = "formular";
$db_host = "localhost";

try {
    $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
        $delete_id = $_POST["delete_id"];
        $sql = "DELETE FROM udaje WHERE id = :delete_id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);
        $stmt->execute();
    }

    $sql = "SELECT id, meno, email, sprava FROM udaje";
    $stmt = $pdo->query($sql);

    echo '<section class="container">';
    echo '<div>';
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo '<div class="blog-main dark-theme">';
        echo '<p>Meno: ' . $row['meno'] . '</p>';
        echo '<p class="blog-email">Email: ' . $row['email'] . '</p>';
        echo '<p>Správa: ' . $row['sprava'] . '</p>';
        echo '<form method="post" class="button-forms">';
        echo '<input type="hidden" name="delete_id" value="' . $row['id'] . '">';
        echo '<button type="submit" class="blog-button button-delete">Delete</button>';
        // echo '<button class="blog-button button-reply">Reply</button>';
        echo '</form>';
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
