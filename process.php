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

// Check if form data is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process form data
    $productName = $_POST["productName"];
    $unit = $_POST["unit"];
    $price = $_POST["price"];
    $expiryDate = $_POST["expiryDate"];
    $inventory = $_POST["inventory"];
    $image = $_FILES["productImage"]["name"];

    // Upload image to a folder (you may need to create the "uploads" folder)
    move_uploaded_file($_FILES["productImage"]["tmp_name"], "uploads/" . $image);

    // Insert data into the database
    $sql = "INSERT INTO products (productName, unit, price, expiryDate, inventory, image)
            VALUES ('$productName', '$unit', '$price', '$expiryDate', '$inventory', '$image')";

    if ($conn->query($sql) === TRUE) {
        echo "Record added successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>
