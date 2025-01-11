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
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updatePayment'])) {
    $orderId = htmlspecialchars($_POST['orderId']);
    $paymentStatus = htmlspecialchars($_POST['paymentStatus']);

    // Validate payment status
    $validStatuses = ['Pending', 'Completed', 'Failed', 'Canceled'];
    if (!in_array($paymentStatus, $validStatuses)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid payment status.']);
        exit;
    }

    try {
        // Update the payment status
        $stmt = $pdo->prepare("UPDATE payments SET payment_status = ? WHERE order_id = ?");
        $stmt->execute([$paymentStatus, $orderId]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Payment status updated successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No rows updated. Check the order ID.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error updating payment status: ' . $e->getMessage()]);
    }
    exit;
}

// Function to fetch orders based on status
function getOrdersByStatus($pdo, $statusFilter) {
    $statusQuery = $statusFilter === 'All' ? "" : "WHERE p.payment_status = ?";
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
        if ($statusFilter !== 'All') {
            $stmt->execute([$statusFilter]);
        } else {
            $stmt->execute();
        }
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Error fetching orders: " . $e->getMessage());
    }
}

// Fetch the status filter from URL (default to 'All')
$statusFilter = isset($_GET['status']) ? $_GET['status'] : 'All';

// Get orders based on status
$reservations = getOrdersByStatus($pdo, $statusFilter);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Reservations with Payment Status</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        nav a.active {
            font-weight: bold;
            color: blue;
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
    <h1>Reservations Dashboard</h1>

    <!-- Navigation Bar -->
    <nav>
        <a href="?status=All" class="<?= $statusFilter === 'All' ? 'active' : ''; ?>">All Orders</a>
        <a href="?status=Pending" class="<?= $statusFilter === 'Pending' ? 'active' : ''; ?>">Pending</a>
        <a href="?status=Completed" class="<?= $statusFilter === 'Completed' ? 'active' : ''; ?>">Completed</a>
        <a href="?status=Canceled" class="<?= $statusFilter === 'Canceled' ? 'active' : ''; ?>">Canceled</a>
    </nav>

    <div id="messageContainer"></div> <!-- Success/Error message container -->

    <!-- Table of Orders -->
    <table border="1" cellpadding="10" cellspacing="0">
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
                                    <option value="Failed" <?= ($reservation['payment_status'] === 'Failed') ? 'selected' : ''; ?>>Failed</option>
                                    <option value="Canceled" <?= ($reservation['payment_status'] === 'Canceled') ? 'selected' : ''; ?>>Canceled</option>
                                </select>
                                <button type="submit" name="updatePayment" class="updateBtn">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10">No reservations found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        $(document).on('submit', '.updateForm', function(event) {
            event.preventDefault();

            var form = $(this);
            var orderId = form.find('input[name="orderId"]').val();
            var paymentStatus = form.find('select[name="paymentStatus"]').val();

            $.ajax({
                type: "POST",
                url: "",
                data: {
                    updatePayment: true,
                    orderId: orderId,
                    paymentStatus: paymentStatus
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        showMessage(result.message, 'success');
                        // Optional: Reload the page with the current status filter
                        window.location.href = "?status=" + "<?= $statusFilter ?>";
                    } else {
                        showMessage(result.message, 'error');
                    }
                },
                error: function() {
                    showMessage('Error occurred while updating the payment status.', 'error');
                }
            });
        });

        function showMessage(message, type) {
            $('#messageContainer').html('<div class="message ' + type + '">' + message + '</div>');
        }
    </script>
</body>
</html>
