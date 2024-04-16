<?php
class Database {
    private $db_username = "root";
    private $db_password = "";
    private $db_name = "formular";
    private $db_host = "localhost";
    private $pdo;

    public function __construct() {
        try {
            $this->pdo = new PDO("mysql:host=$this->db_host;dbname=$this->db_name", $this->db_username, $this->db_password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    public function insertData($meno, $email, $sprava) {
        try {
            $sql = "INSERT INTO udaje (meno, email, sprava) VALUES (:meno, :email, :sprava)";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':meno', $meno, PDO::PARAM_STR);
            $stmt->bindParam(':email', $email, PDO::PARAM_STR);
            $stmt->bindParam(':sprava', $sprava, PDO::PARAM_STR);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error occurred while inserting data: " . $e->getMessage();
            return false;
        }
    }

    public function closeConnection() {
        $this->pdo = null;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $database = new Database();
    $meno = $_POST['meno'];
    $email = $_POST['email'];
    $sprava = $_POST['sprava'];
    $database->insertData($meno, $email, $sprava);
    $database->closeConnection();
    header("Location: ../kontakt.php");
    exit;
}
?>
