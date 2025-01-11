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

// Fetch completed orders from the database
function getCompletedOrders($pdo) {
    $sql = "SELECT 
                o.order_id,
                c.name AS customer_name, 
                c.email, 
                c.phone, 
                o.cake_flavor, 
                o.cake_size, 
                o.special_instructions, 
                o.reservation_date, 
                o.order_date, 
                p.payment_status,
                p.amount
            FROM cake_orders o
            JOIN customers c ON o.customer_id = c.customer_id
            LEFT JOIN payments p ON o.order_id = p.order_id
            WHERE p.payment_status = 'Completed'
            ORDER BY o.reservation_date ASC";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error fetching orders: " . $e->getMessage());
    }
}

// Get completed orders
$completedOrders = getCompletedOrders($pdo);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Completed Orders</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
    </style>
</head>
<body>

<h1>Completed Orders</h1>

<table>
    <thead>
        <tr>
            <th>Order ID</th>
            <th>Customer Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Cake Flavor</th>
            <th>Cake Size</th>
            <th>Special Instructions</th>
            <th>Reservation Date</th>
            <th>Order Date</th>
            <th>Payment Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (!empty($completedOrders)): ?>
            <?php foreach ($completedOrders as $order): ?>
                <tr>
                    <td><?= htmlspecialchars($order['order_id']); ?></td>
                    <td><?= htmlspecialchars($order['customer_name']); ?></td>
                    <td><?= htmlspecialchars($order['email']); ?></td>
                    <td><?= htmlspecialchars($order['phone']); ?></td>
                    <td><?= htmlspecialchars($order['cake_flavor']); ?></td>
                    <td><?= htmlspecialchars($order['cake_size']); ?></td>
                    <td><?= htmlspecialchars($order['special_instructions']); ?></td>
                    <td><?= htmlspecialchars($order['reservation_date']); ?></td>
                    <td><?= htmlspecialchars($order['order_date']); ?></td>
                    <td><?= htmlspecialchars($order['payment_status']); ?></td>
                </tr>
            <?php endforeach; ?>
        <?php else: ?>
            <tr>
                <td colspan="10">No completed orders found.</td>
            </tr>
        <?php endif; ?>
    </tbody>
</table>

</body>
</html>
