<?php
// Database connection
$host = 'localhost';
$db = 'CakeOrderDB';
$user = 'root';
$pass = '';

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $phone = htmlspecialchars($_POST['phone']);
    $cakeFlavor = htmlspecialchars($_POST['cakeFlavor']);
    $cakeSize = htmlspecialchars($_POST['cakeSize']);
    $instructions = htmlspecialchars($_POST['instructions']);
    $reservationDate = htmlspecialchars($_POST['reservationDate']);

    try {
        // Insert customer details
        $stmt = $pdo->prepare("INSERT INTO customers (name, email, phone) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE customer_id=LAST_INSERT_ID(customer_id)");
        $stmt->execute([$name, $email, $phone]);
        $customerId = $pdo->lastInsertId();

        // Insert order details
        $stmt = $pdo->prepare("INSERT INTO cake_orders (customer_id, cake_flavor, cake_size, special_instructions, reservation_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$customerId, $cakeFlavor, $cakeSize, $instructions, $reservationDate]);

        echo "<h2>Order placed successfully!</h2>";
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cake Order Reservation</title>
</head>
<body>
    <h1>Cake Order Reservation</h1>
    <form method="post" action="">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="phone">Phone:</label><br>
        <input type="tel" id="phone" name="phone" required><br><br>

        <label for="cakeFlavor">Cake Flavor:</label><br>
        <select id="cakeFlavor" name="cakeFlavor" required>
            <option value="Vanilla">Vanilla</option>
            <option value="Chocolate">Chocolate</option>
            <option value="Red Velvet">Red Velvet</option>
            <option value="Strawberry">Strawberry</option>
        </select><br><br>

        <label for="cakeSize">Cake Size:</label><br>
        <input type="radio" id="small" name="cakeSize" value="Small" required>
        <label for="small">Small</label><br>
        <input type="radio" id="medium" name="cakeSize" value="Medium">
        <label for="medium">Medium</label><br>
        <input type="radio" id="large" name="cakeSize" value="Large">
        <label for="large">Large</label><br><br>

        <label for="instructions">Special Instructions:</label><br>
        <textarea id="instructions" name="instructions" rows="4" cols="40"></textarea><br><br>

        <label for="reservationDate">Reservation Date:</label><br>
        <input type="date" id="reservationDate" name="reservationDate" required><br><br>

        <button type="submit">Submit Reservation</button>
    </form>
</body>
</html>
