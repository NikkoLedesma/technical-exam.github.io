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

// Fetch records from the database
$sql = "SELECT * FROM products";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        // Calculate the inventory cost
        $inventoryCost = $row['price'] * $row['inventory'];

        echo "<tr>
                <td>{$row['productName']}</td>
                <td>{$row['unit']}</td>
                <td>{$row['price']}</td>
                <td>{$row['expiryDate']}</td>
                <td>{$row['inventory']}</td>
                <td>{$inventoryCost}</td>
                <td><img src='uploads/{$row['image']}' alt='Product Image' style='max-width: 100px; max-height: 100px;'></td>
                <td>
                    <button class='btn btn-primary btn-view' data-id='{$row['id']}'>View</button>
                    <button class='btn btn-warning btn-edit' data-id='{$row['id']}'>Edit</button>
                    <button class='btn btn-danger btn-delete' data-id='{$row['id']}'>Delete</button>
                </td>
            </tr>";
    }
} else {
    echo "<tr><td colspan='8'>No records found</td></tr>";
}

$conn->close();
?>
