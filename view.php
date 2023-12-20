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

if (isset($_GET["id"])) {
    $productId = $_GET["id"];

    // Fetch the record details from the database
    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        // Display detailed information in the modal
        echo "<p><strong>Product Name:</strong> {$row['productName']}</p>";
        echo "<p><strong>Unit:</strong> {$row['unit']}</p>";
        echo "<p><strong>Price:</strong> {$row['price']}</p>";
        echo "<p><strong>Date of Expiry:</strong> {$row['expiryDate']}</p>";
        echo "<p><strong>Available Inventory:</strong> {$row['inventory']}</p>";
        echo "<p><strong>Image:</strong> <img src='uploads/{$row['image']}' alt='Product Image' style='max-width: 100%;'></p>";
    } else {
        echo "Record not found.";
    }
}

$conn->close();
?>
