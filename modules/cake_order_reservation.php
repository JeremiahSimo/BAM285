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
    $paymentMethod = htmlspecialchars($_POST['paymentMethod']);
    $gcashNumber = htmlspecialchars($_POST['gcashNumber'] ?? null);
    $amount = ($cakeSize === "Small") ? 250.00 : (($cakeSize === "Medium") ? 400.00 : 600.00);

    try {
        // Insert customer details
        $stmt = $pdo->prepare("INSERT INTO customers (name, email, phone) VALUES (?, ?, ?) ON DUPLICATE KEY UPDATE customer_id=LAST_INSERT_ID(customer_id)");
        $stmt->execute([$name, $email, $phone]);
        $customerId = $pdo->lastInsertId();

        // Insert order details
        $stmt = $pdo->prepare("INSERT INTO cake_orders (customer_id, cake_flavor, cake_size, special_instructions, reservation_date) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$customerId, $cakeFlavor, $cakeSize, $instructions, $reservationDate]);

        $orderId = $pdo->lastInsertId();

        // Insert payment details
        $stmt = $pdo->prepare("INSERT INTO payments (order_id, amount, payment_method, gcash_number) VALUES (?, ?, ?, ?)");
        $stmt->execute([$orderId, $amount, $paymentMethod, $paymentMethod === "GCash" ? $gcashNumber : null]);

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
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
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
        <label for="small">Small - ₱250.00</label><br>
        <input type="radio" id="medium" name="cakeSize" value="Medium">
        <label for="medium">Medium - ₱400.00</label><br>
        <input type="radio" id="large" name="cakeSize" value="Large">
        <label for="large">Large - ₱600.00</label><br><br>

        <label for="instructions">Special Instructions:</label><br>
        <textarea id="instructions" name="instructions" rows="4" cols="40"></textarea><br><br>

        <label for="reservationDate">Reservation Date:</label><br>
        <input type="date" id="reservationDate" name="reservationDate" required><br><br>

        <label for="paymentMethod">Payment Method:</label><br>
        <select id="paymentMethod" name="paymentMethod" required>
            <option value="Cash">Cash</option>
            <option value="GCash">GCash</option>
        </select><br><br>

        <div id="gcashNumberDiv" style="display: none;">
            <label for="gcashNumber">GCash Number:</label><br>
            <input type="text" id="gcashNumber" name="gcashNumber" placeholder="Enter GCash Number"><br><br>
        </div>

        <button type="submit">Submit Reservation</button>
    </form>

    <script>
        // Show/hide GCash number field based on selected payment method
        $(document).on('change', '#paymentMethod', function() {
            if ($(this).val() === 'GCash') {
                $('#gcashNumberDiv').show();
                $('#gcashNumber').attr('required', true);
            } else {
                $('#gcashNumberDiv').hide();
                $('#gcashNumber').removeAttr('required').val('');
            }
        });
    </script>
</body>
</html>
