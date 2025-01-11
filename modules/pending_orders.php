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

// Function to fetch orders by status (specifically for 'Pending' here)
function getOrdersByStatus($pdo, $statusFilter) {
    // We fetch only 'Pending' orders for this page
    $statusQuery = "WHERE p.payment_status = ?";
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
            $statusQuery
            ORDER BY o.reservation_date ASC";

    try {
        $stmt = $pdo->prepare($sql);
        $stmt->execute([$statusFilter]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error fetching orders: " . $e->getMessage());
    }
}

// Fetch the 'Pending' orders from the database
$statusFilter = 'Pending'; // Always show 'Pending' orders on this page
$reservations = getOrdersByStatus($pdo, $statusFilter);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Orders</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        nav {
            margin-bottom: 20px;
            background-color: #f4f4f4;
            padding: 10px;
        }
        nav a {
            margin-right: 15px;
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        nav a.active {
            color: #007BFF;
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
        #messageContainer {
            margin-bottom: 20px;
        }
        .message {
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid transparent;
        }
        .message.success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }
        .message.error {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>
<body>
    <h1>Pending Orders</h1>

    <!-- Navigation Bar -->
    <nav>
        <a href="pending_orders.php?status=Pending" class="active">Pending</a>
        <a href="admin_reservations.php?status=All">All Orders</a>
        <a href="admin_reservations.php?status=Completed">Completed</a>
        <a href="admin_reservations.php?status=Canceled">Canceled</a>
    </nav>

    <div id="messageContainer"></div> <!-- Success/Error message container -->

    <!-- Table of Orders -->
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
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($reservations)): ?>
                <?php foreach ($reservations as $reservation): ?>
                    <tr id="order_<?= htmlspecialchars($reservation['order_id']); ?>">
                        <td><?= htmlspecialchars($reservation['order_id']); ?></td>
                        <td><?= htmlspecialchars($reservation['customer_name']); ?></td>
                        <td><?= htmlspecialchars($reservation['email']); ?></td>
                        <td><?= htmlspecialchars($reservation['phone']); ?></td>
                        <td><?= htmlspecialchars($reservation['cake_flavor']); ?></td>
                        <td><?= htmlspecialchars($reservation['cake_size']); ?></td>
                        <td><?= htmlspecialchars($reservation['special_instructions']); ?></td>
                        <td><?= htmlspecialchars($reservation['reservation_date']); ?></td>
                        <td><?= htmlspecialchars($reservation['order_date']); ?></td>
                        <td>
                            <form class="updateForm" method="POST" data-order-id="<?= htmlspecialchars($reservation['order_id']); ?>">
                                <input type="hidden" name="orderId" value="<?= htmlspecialchars($reservation['order_id']); ?>">
                                <select name="paymentStatus" required>
                                    <option value="Pending" <?= ($reservation['payment_status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Completed" <?= ($reservation['payment_status'] === 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                    <option value="Canceled" <?= ($reservation['payment_status'] === 'Canceled') ? 'selected' : ''; ?>>Canceled</option>
                                </select>
                                <button type="submit" name="updatePayment" class="updateBtn">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">No pending reservations found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
