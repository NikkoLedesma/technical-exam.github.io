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
    // Process form data
    $productId = $_POST["id"];
    $editProductName = $_POST["editProductName"];
    $editUnit = $_POST["editUnit"];
    $editPrice = $_POST["editPrice"];
    $editExpiryDate = $_POST["editExpiryDate"];
    $editInventory = $_POST["editInventory"];
    $editProductImage = isset($_FILES["editProductImage"]) ? $_FILES["editProductImage"]["name"] : '';

    // Update data in the database
    $sql = "UPDATE products SET
            productName = '$editProductName',
            unit = '$editUnit',
            price = '$editPrice',
            expiryDate = '$editExpiryDate',
            inventory = '$editInventory'";

    // Update image if a new image is provided
    if ($editProductImage) {
        move_uploaded_file($_FILES["editProductImage"]["tmp_name"], "uploads/" . $editProductImage);
        $sql .= ", image = '$editProductImage'";
    }

    $sql .= " WHERE id = $productId";

    if ($conn->query($sql) === TRUE) {
        echo "Record updated successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// ... close database connection ...
?>
