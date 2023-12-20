<?php
// Establish a connection to the database (replace with your own credentials)
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'product_management';

$conn = new mysqli($host, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $productId = $_POST["id"];

    // Delete the record from the database
    $sql = "DELETE FROM products WHERE id = $productId";

    if ($conn->query($sql) === TRUE) {
        echo "Record deleted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// ... close database connection ...
?>
