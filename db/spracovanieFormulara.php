<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "formular";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->conne

ct_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected successfully";

// Example data to be inserted
$meno = $_GET['meno'] ?? '';
$email = $_GET['email'] ?? '';
$sprava = $_GET['sprava'] ?? '';

// SQL query to insert data into a table named "users"
$sql = "INSERT INTO udaje (meno, email, sprava) VALUES ('$meno', '$email', '$sprava')";

if ($conn->query($sql) === TRUE) {
    header("Location: http://localhost/sablona/thankyou.php");
    exit; // Stop further execution after redirection
} else {
    echo "Error: " . $conn->error;
}

// Close the connection
$conn->close();
?>