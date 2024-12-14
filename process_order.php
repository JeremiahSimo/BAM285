<?php
// Database connection credentials
$host = 'localhost';
$dbname = 'cake_order_db'; // Name of your database
$username = 'root'; // Change if different
$password = ''; // Change if needed

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Check if the form is submitted
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        // Retrieve form data
        $customer_name = $_POST['customer_name'];
        $phone_number = $_POST['phone_number'];
        $email = $_POST['email'] ?? null;
        $address = $_POST['address'];
        $cake_id = $_POST['cake_id'];
        $quantity = $_POST['quantity'];

        // Fetch the price of the selected cake from the database
        $stmt = $pdo->prepare("SELECT price FROM cakes WHERE cake_id = ?");
        $stmt->execute([$cake_id]);
        $cake = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cake) {
            throw new Exception('Invalid cake selection.');
        }

        $price = $cake['price'];
        $total_amount = $price * $quantity;

        // Insert customer data into the database
        $stmt = $pdo->prepare("INSERT INTO customers (customer_name, phone_number, email, address) VALUES (?, ?, ?, ?)");
        $stmt->execute([$customer_name, $phone_number, $email, $address]);

        // Get the last inserted customer ID
        $customer_id = $pdo->lastInsertId();

        // Insert order data into the database
        $stmt = $pdo->prepare("INSERT INTO orders (customer_id, total_amount) VALUES (?, ?)");
        $stmt->execute([$customer_id, $total_amount]);

        // Get the last inserted order ID
        $order_id = $pdo->lastInsertId();

        // Insert order details into the database
        $stmt = $pdo->prepare("INSERT INTO order_details (order_id, cake_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $cake_id, $quantity, $price]);

        // Confirm order placement
        echo "Order placed successfully! Your order ID is: " . $order_id;
    }
} catch (PDOException $e) {
    // Handle database connection errors
    echo "Database error: " . $e->getMessage();
} catch (Exception $e) {
    // Handle any other errors
    echo "Error: " . $e->getMessage();
}
?>
