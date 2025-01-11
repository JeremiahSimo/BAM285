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

// Handle payment status and amount updates
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updatePayment'])) {
    $orderId = htmlspecialchars($_POST['orderId']);
    $paymentStatus = htmlspecialchars($_POST['paymentStatus']);
    $amountPaid = htmlspecialchars($_POST['amountPaid']);

    // Validate payment status
    $validStatuses = ['Pending', 'Completed', 'Failed', 'Canceled'];
    if (!in_array($paymentStatus, $validStatuses)) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid payment status.']);
        exit;
    }

    // Validate amount
    if (!is_numeric($amountPaid) || $amountPaid < 0) {
        echo json_encode(['status' => 'error', 'message' => 'Invalid amount entered.']);
        exit;
    }

    try {
        // Update payment in database
        $stmt = $pdo->prepare("UPDATE payments SET payment_status = ?, amount = ? WHERE order_id = ?");
        $stmt->execute([$paymentStatus, $amountPaid, $orderId]);

        if ($stmt->rowCount() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Payment updated successfully!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'No changes made. Check the order ID.']);
        }
    } catch (PDOException $e) {
        echo json_encode(['status' => 'error', 'message' => 'Database error: ' . $e->getMessage()]);
    }
    exit;
}

// Fetch all orders
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
        p.payment_status, 
        p.amount 
    FROM cake_orders o
    JOIN customers c ON o.customer_id = c.customer_id
    LEFT JOIN payments p ON o.order_id = p.order_id
    ORDER BY o.reservation_date ASC");
    $orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    die("Error fetching orders: " . $e->getMessage());
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Payment Management</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    <h1>Admin Dashboard</h1>
    <div id="messageContainer"></div>

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
                <th>Amount Paid</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($orders as $order): ?>
                <tr id="order_<?= htmlspecialchars($order['order_id']); ?>">
                    <td><?= htmlspecialchars($order['order_id']); ?></td>
                    <td><?= htmlspecialchars($order['customer_name']); ?></td>
                    <td><?= htmlspecialchars($order['email']); ?></td>
                    <td><?= htmlspecialchars($order['phone']); ?></td>
                    <td><?= htmlspecialchars($order['cake_flavor']); ?></td>
                    <td><?= htmlspecialchars($order['cake_size']); ?></td>
                    <td><?= htmlspecialchars($order['special_instructions']); ?></td>
                    <td><?= htmlspecialchars($order['reservation_date']); ?></td>
                    <td><?= htmlspecialchars($order['order_date']); ?></td>
                    <td id="status_<?= htmlspecialchars($order['order_id']); ?>"><?= htmlspecialchars($order['payment_status'] ?? 'Pending'); ?></td>
                    <td id="amount_<?= htmlspecialchars($order['order_id']); ?>"><?= htmlspecialchars($order['amount'] ?? '0.00'); ?></td>
                    <td>
                        <form class="updateForm" method="POST">
                            <input type="hidden" name="orderId" value="<?= htmlspecialchars($order['order_id']); ?>">
                            <select name="paymentStatus" required>
                                <option value="Pending" <?= ($order['payment_status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                <option value="Completed" <?= ($order['payment_status'] === 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                <option value="Failed" <?= ($order['payment_status'] === 'Failed') ? 'selected' : ''; ?>>Failed</option>
                                <option value="Canceled" <?= ($order['payment_status'] === 'Canceled') ? 'selected' : ''; ?>>Canceled</option>
                            </select>
                            <input type="number" name="amountPaid" step="0.01" min="0" value="<?= htmlspecialchars($order['amount'] ?? '0.00'); ?>" required>
                            <button type="submit" name="updatePayment">Update</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <script>
        $(document).on('submit', '.updateForm', function(e) {
            e.preventDefault();

            const form = $(this);
            const orderId = form.find('input[name="orderId"]').val();
            const paymentStatus = form.find('select[name="paymentStatus"]').val();
            const amountPaid = form.find('input[name="amountPaid"]').val();

            $.post("", { updatePayment: true, orderId, paymentStatus, amountPaid }, function(response) {
                const result = JSON.parse(response);

                if (result.status === 'success') {
                    $(`#status_${orderId}`).text(paymentStatus);
                    $(`#amount_${orderId}`).text(amountPaid);
                    form.find('button').hide(); 
                    $('#messageContainer').html(`<p style="color:green;">${result.message}</p>`);
                } else {
                    $('#messageContainer').html(`<p style="color:red;">${result.message}</p>`);
                }
            }).fail(function() {
                $('#messageContainer').html('<p style="color:red;">Error processing the request.</p>');
            });
        });
    </script>
</body>
</html>
