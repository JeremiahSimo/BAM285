<?php
// Database connection credentials
$host = 'localhost';
$dbname = 'cake_order_db';
$username = 'root'; // Adjust as per your MySQL setup
$password = ''; // Adjust as per your MySQL setup

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$cake_order_db", $username, $password);
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

        // Validate email if provided
        if (!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "Invalid email format.";
            exit;
        }

        // Fetch the price of the selected cake
        $stmt = $pdo->prepare("SELECT price FROM cakes WHERE cake_id = ?");
        $stmt->execute([$cake_id]);
        $cake = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$cake) {
            throw new Exception('Invalid cake selection.');
        }

        $price = $cake['price'];
        $total_amount = $price * $quantity;

        // Insert customer data
        $stmt = $pdo->prepare("INSERT INTO customers (customer_name, phone_number, email, address) VALUES (?, ?, ?, ?)");
        $stmt->execute([$customer_name, $phone_number, $email, $address]);

        $customer_id = $pdo->lastInsertId();

        // Insert order data
        $stmt = $pdo->prepare("INSERT INTO orders (customer_id, total_amount) VALUES (?, ?)");
        $stmt->execute([$customer_id, $total_amount]);

        $order_id = $pdo->lastInsertId();

        // Insert order details
        $stmt = $pdo->prepare("INSERT INTO order_details (order_id, cake_id, quantity, price) VALUES (?, ?, ?, ?)");
        $stmt->execute([$order_id, $cake_id, $quantity, $price]);

        // Redirect or show confirmation
        echo "Order placed successfully!";
    }
} catch (PDOException $e) {
    error_log($e->getMessage(), 3, '/var/log/cake_order_errors.log');
    echo "Database error. Please try again later.";
} catch (Exception $e) {
    error_log($e->getMessage(), 3, '/var/log/cake_order_errors.log');
    echo "Error: " . $e->getMessage();
}
?>
