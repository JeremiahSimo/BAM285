<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Reservations with Payment Options</title>
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
                <th>Amount Paid</th>
                <th>Payment Method</th>
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
                        <td id="amount_<?= htmlspecialchars($reservation['order_id']); ?>"><?= htmlspecialchars($reservation['amount'] ?? 'N/A'); ?></td>
                        <td id="method_<?= htmlspecialchars($reservation['order_id']); ?>"><?= htmlspecialchars($reservation['payment_method'] ?? 'N/A'); ?></td>
                        <td>
                            <form class="updateForm" method="POST" data-order-id="<?= htmlspecialchars($reservation['order_id']); ?>">
                                <input type="hidden" name="orderId" value="<?= htmlspecialchars($reservation['order_id']); ?>">
                                <select name="paymentStatus" required>
                                    <option value="Pending" <?= ($reservation['payment_status'] === 'Pending') ? 'selected' : ''; ?>>Pending</option>
                                    <option value="Completed" <?= ($reservation['payment_status'] === 'Completed') ? 'selected' : ''; ?>>Completed</option>
                                    <option value="Failed" <?= ($reservation['payment_status'] === 'Failed') ? 'selected' : ''; ?>>Failed</option>
                                    <option value="Canceled" <?= ($reservation['payment_status'] === 'Canceled') ? 'selected' : ''; ?>>Canceled</option>
                                </select>
                                <input type="number" name="amountPaid" step="0.01" min="0" value="<?= htmlspecialchars($reservation['amount']); ?>" placeholder="Amount Paid" required>
                                <select name="paymentMethod" class="paymentMethod" required>
                                    <option value="Cash" <?= ($reservation['payment_method'] === 'Cash') ? 'selected' : ''; ?>>Cash</option>
                                    <option value="GCash" <?= ($reservation['payment_method'] === 'GCash') ? 'selected' : ''; ?>>GCash</option>
                                </select>
                                <input type="text" name="gcashNumber" class="gcashNumber" placeholder="GCash Number" value="<?= htmlspecialchars($reservation['gcash_number'] ?? ''); ?>" style="display: <?= ($reservation['payment_method'] === 'GCash') ? 'block' : 'none'; ?>;">
                                <button type="submit" name="updatePayment" class="updateBtn">Update</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="13">No reservations found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        // Handle form submission via AJAX
        $(document).on('submit', '.updateForm', function(event) {
            event.preventDefault();

            var form = $(this);
            var orderId = form.find('input[name="orderId"]').val();
            var paymentStatus = form.find('select[name="paymentStatus"]').val();
            var amountPaid = form.find('input[name="amountPaid"]').val();
            var paymentMethod = form.find('select[name="paymentMethod"]').val();
            var gcashNumber = form.find('input[name="gcashNumber"]').val();

            // Validate GCash number if GCash is selected
            if (paymentMethod === 'GCash' && gcashNumber.trim() === '') {
                showMessage('GCash number is required for GCash payments.', 'error');
                return;
            }

            // Send AJAX request
            $.ajax({
                type: "POST",
                url: "", // Current page
                data: {
                    updatePayment: true,
                    orderId: orderId,
                    paymentStatus: paymentStatus,
                    amountPaid: amountPaid,
                    paymentMethod: paymentMethod,
                    gcashNumber: paymentMethod === 'GCash' ? gcashNumber : ''
                },
                success: function(response) {
                    var result = JSON.parse(response);
                    if (result.status === 'success') {
                        // Update status and amount on the page
                        $('#status_' + orderId).text(paymentStatus);
                        $('#amount_' + orderId).text(amountPaid); 
                        $('#method_' + orderId).text(paymentMethod);
                        showMessage(result.message, 'success');
                    } else {
                        showMessage(result.message, 'error');
                    }
                },
                error: function() {
                    showMessage('Error occurred while updating the payment.', 'error');
                }
            });
        });

        // Toggle GCash input visibility based on selected payment method
        $(document).on('change', '.paymentMethod', function() {
            var gcashInput = $(this).closest('form').find('.gcashNumber');
            if ($(this).val() === 'GCash') {
                gcashInput.show();
            } else {
                gcashInput.hide();
                gcashInput.val(''); // Clear GCash number if not GCash
            }
        });

        // Function to show messages
        function showMessage(message, type) {
            $('#messageContainer').html('<div class="message ' + type + '">' + message + '</div>');
        }
    </script>
</body>
</html>
