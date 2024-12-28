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

// Fetch all reservations
try {
    $stmt = $pdo->query("SELECT 
        c.name AS customer_name, 
        c.email, 
        c.phone, 
        o.cake_flavor, 
        o.cake_size, 
        o.special_instructions, 
        o.reservation_date, 
        o.order_date 
    FROM cake_orders o
    JOIN customers c ON o.customer_id = c.customer_id
    ORDER BY o.reservation_date ASC");
    $reservations = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching reservations: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Reservations</title>
</head>
<body>
    <h1>Reservations Dashboard</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Cake Flavor</th>
                <th>Cake Size</th>
                <th>Special Instructions</th>
                <th>Reservation Date</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($reservations)): ?>
                <?php foreach ($reservations as $reservation): ?>
                    <tr>
                        <td><?= htmlspecialchars($reservation['customer_name']); ?></td>
                        <td><?= htmlspecialchars($reservation['email']); ?></td>
                        <td><?= htmlspecialchars($reservation['phone']); ?></td>
                        <td><?= htmlspecialchars($reservation['cake_flavor']); ?></td>
                        <td><?= htmlspecialchars($reservation['cake_size']); ?></td>
                        <td><?= htmlspecialchars($reservation['special_instructions']); ?></td>
                        <td><?= htmlspecialchars($reservation['reservation_date']); ?></td>
                        <td><?= htmlspecialchars($reservation['order_date']); ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8">No reservations found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
