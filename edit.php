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

        // Display the edit form with pre-filled values
        echo "<form id='editForm'>
                <input type='hidden' name='id' value='{$row['id']}'>
                <div class='form-group'>
                    <label for='editProductName'>Product Name</label>
                    <input type='text' class='form-control' id='editProductName' name='editProductName' value='{$row['productName']}' required>
                </div>
                <div class='form-group'>
                    <label for='editUnit'>Unit</label>
                    <input type='text' class='form-control' id='editUnit' name='editUnit' value='{$row['unit']}' required>
                </div>
                <div class='form-group'>
                    <label for='editPrice'>Price</label>
                    <input type='number' class='form-control' id='editPrice' name='editPrice' value='{$row['price']}' min='0' step='0.01' required>
                </div>
                <div class='form-group'>
                    <label for='editExpiryDate'>Date of Expiry</label>
                    <input type='date' class='form-control' id='editExpiryDate' name='editExpiryDate' value='{$row['expiryDate']}' min='" . date('Y-m-d') . "' required>
                </div>
                <div class='form-group'>
                    <label for='editInventory'>Available Inventory</label>
                    <input type='number' class='form-control' id='editInventory' name='editInventory' value='{$row['inventory']}' min='0' required>
                </div>
                <div class='form-group'>
                    <label for='editProductImage'>Product Image</label>
                    <input type='file' class='form-control-file' id='editProductImage' name='editProductImage' accept='image/*'>
                </div>
            </form>";
    } else {
        echo "Record not found.";
    }
}

// ... close database connection ...
?>