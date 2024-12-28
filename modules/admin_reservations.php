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

// Update payment status (AJAX)
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
        $stmt = $pdo->prepare("UPDATE payments SET payment_status = ? WHERE order_id = ?");
        $stmt->execute([$paymentStatus, $orderId]);
        echo json_encode(['status' => 'success', 'message' => 'Payment status updated successfully!']);
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Error updating payment status: ' . $e->getMessage()]);
    }
    exit;
}

// Fetch all reservations
try {
    $stmt = $pdo->query("SELECT 
        o.order_id,
        c.name AS customer_name, 
        c.email, 
        c.phone, 
        o.cake_flavor, 
        o.cake_size, 
        o.special_instructions, 
        o.reservation_date, 
        o.order_date, 
        p.payment_status
    FROM cake_orders o
    JOIN customers c ON o.customer_id = c.customer_id
    LEFT JOIN payments p ON o.order_id = p.order_id
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
    <title>Admin - Reservations with Payment Status</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Reservations Dashboard</h1>

    <div id="messageContainer"></div> <!-- Success/Error message container -->

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
                <th>Payment Status</th>
                <th>Action</th>
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
                        <td id="status_<?= htmlspecialchars($reservation['order_id']); ?>"><?= htmlspecialchars($reservation['payment_status'] ?? 'Pending'); ?></td>
                        <td>
                            <select class="paymentStatus" data-order-id="<?= htmlspecialchars($reservation['order_id']); ?>" onchange="updatePaymentStatus(this)">
                                <option value="Pending" <?= ($reservation['payment_status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="Completed" <?= ($reservation['payment_status'] === 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                <option value="Failed" <?= ($reservation['payment_status'] === 'Failed') ? 'selected' : ''; ?>>Failed</option>
                                <option value="Canceled" <?= ($reservation['payment_status'] === 'Canceled') ? 'selected' : ''; ?>>Canceled</option>
                            </select>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="11">No reservations found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        function updatePaymentStatus(selectElement) {
            var orderId = $(selectElement).data('order-id');
            var paymentStatus = $(selectElement).val();

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
                        $('#status_' + orderId).text(paymentStatus);
                        showMessage(result.message, 'success');
                    } else {
                        showMessage(result.message, 'error');
                    }
                },
                error: function() {
                    showMessage('Error occurred while updating the payment status.', 'error');
                }
            });
        }

        function showMessage(message, type) {
            $('#messageContainer').html('<div class="message ' + type + '">' + message + '</div>');
        }
    </script>
</body>
</html>
