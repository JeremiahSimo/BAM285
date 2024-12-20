<?php
// Database connection credentials
$host = 'localhost';
$dbname = 'cake_shop'; // Name of your database
$username = 'root'; // Change if different
$password = ''; // Change if needed

try {
    // Create a new PDO connection
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Initialize variables for error messages or success output
    $error_message = "";
    $success_message = "";

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

        // Success message
        $success_message = "Order placed successfully! Your order ID is: " . $order_id;
    }
} catch (PDOException $e) {
    // Handle database connection errors
    $error_message = "Database error: " . $e->getMessage();
} catch (Exception $e) {
    // Handle any other errors
    $error_message = "Error: " . $e->getMessage();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Order Form</title>
</head>
<body>
    <h1>Cake Order Form</h1>
    
    <?php if ($error_message): ?>
        <p style="color: red;"><?php echo htmlspecialchars($error_message); ?></p>
    <?php endif; ?>
    
    <?php if ($success_message): ?>
        <p style="color: green;"><?php echo htmlspecialchars($success_message); ?></p>
    <?php else: ?>
        <form action="" method="POST">
            <!-- Customer Details -->
            <fieldset>
                <legend>Customer Details</legend>
                <label for="customer_name">Name:</label>
                <input type="text" id="customer_name" name="customer_name" required><br><br>

                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email"><br><br>

                <label for="address">Address:</label><br>
                <textarea id="address" name="address" rows="4" cols="50" required></textarea><br><br>
            </fieldset>

            <!-- Cake Selection -->
            <fieldset>
                <legend>Select Your Cake</legend>

                <label for="cake_id">Cake:</label>
                <select id="cake_id" name="cake_id" required>
                    <option value="1">Chocolate Cake</option>
                    <option value="2">Vanilla Cake</option>
                    <option value="3">Red Velvet Cake</option>
                </select><br><br>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" required><br><br>
            </fieldset>

            <!-- Order Submission -->
            <input type="submit" value="Place Order">
        </form>
    <?php endif; ?>
</body>
</html>
