<?php
// Prihlasovacie údaje k databáze
$db_username = "root";
$db_password = "";
$db_name = "formular";
$db_host = "localhost"; 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        // Pripojenie k databáze pomocou PDO
        $pdo = new PDO("mysql:host=$db_host;dbname=$db_name", $db_username, $db_password);
        
        // Nastavenie režimu chybových výpisov pre PDO
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Príprava SQL dotazu pre vloženie údajov
        $sql = "INSERT INTO udaje (meno, email, sprava) VALUES (:meno, :email, :sprava)";
        
        // Hodnoty získané z formulára
        $meno = $_POST['meno'];
        $email = $_POST['email'];
        $sprava = $_POST['sprava'];
        
        // Príprava a vykonanie príkazu pomocou PDO prepared statement
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':meno', $meno, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':sprava', $sprava, PDO::PARAM_STR);
        $stmt->execute();
        
        // Debugging: Output fetched data
        $udaje = $stmt->fetchAll(PDO::FETCH_ASSOC);
        var_dump($udaje);

        // Presmerovanie na stranku
        header("Location: ../kontakt.php");
        exit;

    } catch (PDOException $e) {
        echo "Error occurred while inserting data: " . $e->getMessage();
        exit; 
    }

    // Uzavretie spojenia s databázou
    $pdo = null;
}
?>
