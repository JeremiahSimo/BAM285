<?php
// Assuming you are using MySQLi for connection

// Database connection
$servername = "localhost"; // or your server address
$username = "root"; // or your database username
$password = ""; // or your database password
$dbname = "food_ordering_system"; // your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// 1. Insert a new customer
$receipt_number = 'R12345';
$sql = "INSERT INTO customers (receipt_number) VALUES ('$receipt_number')";
if ($conn->query($sql) === TRUE) {
    $customer_id = $conn->insert_id; // Get the last inserted customer ID
    echo "New customer created successfully. Customer ID: " . $customer_id . "<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 2. Insert a new order for the customer
$order_number = 'ORD12345';
$sql = "INSERT INTO orders (customer_id, order_number) VALUES ('$customer_id', '$order_number')";
if ($conn->query($sql) === TRUE) {
    $order_id = $conn->insert_id; // Get the last inserted order ID
    echo "New order created successfully. Order ID: " . $order_id . "<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 3. Insert items into the order
$food_id = 1; // Assuming food item with ID 1 (e.g., Pizza)
$quantity = 2;
$sql = "INSERT INTO order_items (order_id, food_id, quantity) VALUES ('$order_id', '$food_id', '$quantity')";
if ($conn->query($sql) === TRUE) {
    echo "Order item added successfully.<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

// 4. Calculate the total amount for the order (simplified)
$total_amount = 25.99; // Example total amount for the order
$sql = "INSERT INTO sales (order_id, total_amount) VALUES ('$order_id', '$total_amount')";
if ($conn->query($sql) === TRUE) {
    echo "Sale recorded successfully.<br>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
