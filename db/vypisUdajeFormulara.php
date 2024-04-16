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

    public function deleteData($delete_id) {
        try {
            $sql = "DELETE FROM udaje WHERE id = :delete_id";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':delete_id', $delete_id, PDO::PARAM_INT);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Error occurred while deleting data: " . $e->getMessage();
            return false;
        }
    }

    public function getAllData() {
        $sql = "SELECT id, meno, email, sprava FROM udaje";
        $stmt = $this->pdo->query($sql);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function closeConnection() {
        $this->pdo = null;
    }
}

$database = new Database();
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["delete_id"])) {
    $delete_id = $_POST["delete_id"];
    $database->deleteData($delete_id);
}

$udaje = $database->getAllData();
?>

<section class="container">
    <div>
        <?php foreach ($udaje as $row): ?>
        <div class="blog-main dark-theme">
            <p>Meno: <?php echo $row['meno']; ?></p>
            <p class="blog-email">Email: <?php echo $row['email']; ?></p>
            <p>Správa: <?php echo $row['sprava']; ?></p>
            <form method="post" class="button-forms">
                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                <button type="submit" class="blog-button button-delete">Delete</button>
            </form>
            <br><br>
        </div>
        <?php endforeach; ?>
    </div>
</section>

<?php
$database->closeConnection();
?>
