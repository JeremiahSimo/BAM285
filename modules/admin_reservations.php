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

// Handle status updates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateStatus'])) {
    $orderId = htmlspecialchars($_POST['orderId']);
    $newStatus = htmlspecialchars($_POST['status']);

    try {
        // Update the status in the database
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
        $stmt->execute([$newStatus, $orderId]);
        header("Location: ?status=$newStatus");
        exit;
    } catch (PDOException $e) {
        die("Error updating order status: " . $e->getMessage());
    }
}

// Get orders based on status filter
$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'All';
function getOrders($pdo, $statusFilter)
{
    $query = "SELECT * FROM orders";
    if ($statusFilter !== 'All') {
        $query .= " WHERE status = ?";
    }
    $query .= " ORDER BY reservation_date ASC";

    $stmt = $pdo->prepare($query);
    if ($statusFilter !== 'All') {
        $stmt->execute([$statusFilter]);
    } else {
        $stmt->execute();
    }

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

$orders = getOrders($pdo, $statusFilter);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Order Management</title>
    <style>
        nav a {
            margin: 0 10px;
            text-decoration: none;
            color: black;
        }
        nav a.active {
            font-weight: bold;
            color: blue;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table th, table td {
            border: 1px solid #ccc;
            padding: 8px;
            text-align: center;
        }
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
    <h1>Order Management</h1>

    <!-- Navigation Bar -->
    <nav>
        <a href="?status=All" class="<?= $statusFilter === 'All' ? 'active' : ''; ?>">All Orders</a>
        <a href="?status=Pending" class="<?= $statusFilter === 'Pending' ? 'active' : ''; ?>">Pending</a>
        <a href="?status=Completed" class="<?= $statusFilter === 'Completed' ? 'active' : ''; ?>">Completed</a>
        <a href="?status=Canceled" class="<?= $statusFilter === 'Canceled' ? 'active' : ''; ?>">Canceled</a>
    </nav>

    <!-- Orders Table -->
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
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($orders)): ?>
                <?php foreach ($orders as $order): ?>
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
                        <td><?= htmlspecialchars($order['status']); ?></td>
                        <td>
                            <!-- Update Status Form -->
                            <form method="POST" style="display: inline;">
                                <input type="hidden" name="orderId" value="<?= htmlspecialchars($order['order_id']); ?>">
                                <select name="status" required>
                                    <option value="Pending" <?= $order['status'] === 'Pending' ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Completed" <?= $order['status'] === 'Completed' ? 'selected' : ''; ?>>Completed</option>
                                    <option value="Canceled" <?= $order['status'] === 'Canceled' ? 'selected' : ''; ?>>Canceled</option>
                                </select>
                                <button type="submit" name="updateStatus">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11">No orders found for the selected status.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>
