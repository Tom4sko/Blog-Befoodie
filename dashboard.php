<!DOCTYPE html>
<html lang="sk">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Moja stránka</title>
    <link rel="stylesheet" href="css/form.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/banner.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>
  
  <?php
    include "components/navbar.php";
  ?> 

<main class="dashboard-main">
<?php
    require "db/database.php";

    // Vytvorenie inštancie triedy Database a získanie PDO pripojenia
    $databaza = new Database();
    $pdo = $databaza->getPdo();

    // Skontrolovanie, či je používateľ administrátor
    if (isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin') {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = $_POST['id'];
            $name = $_POST['name'];
            $email = $_POST['email'];
            $role = $_POST['role'];

            // SQL príkaz na aktualizáciu používateľských údajov
            $sql = "UPDATE users SET name=?, email=?, role=? WHERE id=?";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([$name, $email, $role, $id]);
        }

        // SQL príkaz na získanie všetkých používateľov
        $sql = "SELECT id, name, email, role, password FROM users";
        $stmt = $pdo->query($sql);

        // Vytvorenie tabuľky pre zobrazenie používateľov
        echo "<br><br><br><br>";
        echo "<table class='user-table'>";
        echo "<tr><th>ID</th><th>Meno</th><th>Email</th><th>Heslo</th><th>Rola</th><th>Vymazať</th></tr>";
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
            echo "<td>{$row['id']}</td>";
            echo "<td>{$row['name']}</td>";
            echo "<td>{$row['email']}</td>";
            echo "<td>{$row['password']}</td>";
            echo "<td>{$row['role']}</td>";
            echo "<td><a href='db/delete_user.php?id={$row['id']}'>Vymazať</a></td>";
            echo "</tr>";
        }
        echo "</table>";

        // Formulár na zmenu používateľských údajov
        echo "<br><br><br><br>";
        echo "<form method='post'>";
        echo "<h2 class='dashboard-text'>Zmena Udajov</h2>";

        echo "<input class='dashboard-input' type='text' name='id' placeholder='ID používateľa'><br>";
        echo "<input class='dashboard-input' type='text' name='name' placeholder='Meno'><br>";
        echo "<input class='dashboard-input' type='email' name='email' placeholder='Email'><br>";
        echo "<select class='dashboard-radio' name='role'>
                    <option value='admin'>Admin</option>
                    <option value='user'>User</option>
                </select><br>";
        echo "<input class='dashboard-button' type='submit' value='Upraviť'>";
        echo "</form>";

        echo "<br><br><br><br>";
    } else {
        // Ak používateľ nie je administrátor, zobrazí sa správa o nedostatočných oprávneniach
        echo "<br><br><br><p class='color-theme'>Prístup len pre administrátorov.</p><br><br><br>";
    }
?>
</main>

  <?php
    include "components/footer.php";
  ?>

</body>
</html>
