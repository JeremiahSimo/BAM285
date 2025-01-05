<?php
$host = 'localhost';
$username = 'root';  // your database username
$password = '';      // your database password
$dbname = 'inventory_db';  // your database name

$conn = new mysqli($host, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cart = json_decode($_POST['cart'], true);  // Get cart data from the POST request
    $cartTotal = $_POST['cartTotal'];

    // Clear previous cart entries (you can adjust this logic based on your needs)
    $conn->query("DELETE FROM cart");

    // Insert new cart data
    foreach ($cart as $item) {
        $name = $conn->real_escape_string($item['name']);
        $price = $item['price'];
        $conn->query("INSERT INTO cart (name, price) VALUES ('$name', $price)");
    }

    // Optionally, update the total price
    $conn->query("UPDATE cart SET total_price = $cartTotal WHERE id = 1");

    echo json_encode(["status" => "success", "message" => "Cart updated successfully."]);
}

$conn->close();
?>
