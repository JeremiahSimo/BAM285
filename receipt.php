<?php
session_start();

// Check if the order number is set, if not, redirect to index
if (!isset($_SESSION['order_number']) || !isset($_SESSION['cart'])) {
    header("Location: index.php");
    exit();
}

// Get the order number
$order_number = $_SESSION['order_number'];
$cart = $_SESSION['cart'];

// Calculate the total price
$total_price = 0;
foreach ($cart as $item) {
    $total_price += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Receipt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            text-align: center;
            padding: 50px;
        }

        h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
        }

        .receipt-container {
            background-color: #f4f4f4;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
            text-align: left;
            display: inline-block;
            width: 60%;
        }

        .receipt-container p {
            font-size: 1.2rem;
        }

        .receipt-items {
            margin-bottom: 20px;
        }

        .receipt-items .item {
            display: flex;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .new-transaction-btn {
            background-color: #6a89cc;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.2rem;
            transition: background-color 0.3s ease;
        }

        .new-transaction-btn:hover {
            background-color: #4f6fbb;
        }
    </style>
</head>
<body>



    <div class="receipt-container">
       <center> <h2>Your order number is: <strong><?= $order_number ?></strong></h2></center>
        <p>Order Details:</p>
        
        <!-- List of items ordered -->
        <div class="receipt-items">
            <?php foreach ($cart as $item): ?>
                <div class="item">
                    <span><?= $item['name'] ?> (x<?= $item['quantity'] ?>)</span>
                    <span>₱<?= number_format($item['price'] * $item['quantity'], 2) ?></span>
                </div>
            <?php endforeach; ?>
        </div>

        <p><strong>Total Price: <?= number_format($total_price, 2) ?></strong></p>
        <p>Your order has been successfully processed. Kindly pay in Cashier and wait for your food. Thank you!</p>
    </div>

    <!-- New Transaction Button -->
    <form action="home_page.php" method="get">
        <button type="submit" class="new-transaction-btn" name="new_transaction" value="true">New Transaction</button>
    </form>

</body>
</html>
