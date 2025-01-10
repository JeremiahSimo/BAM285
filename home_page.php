<?php
session_start();

// Clear session if "New Transaction" is triggered
if (isset($_GET['new_transaction']) && $_GET['new_transaction'] === 'true') {
    unset($_SESSION['cart']);
    unset($_SESSION['order_number']);
}

// Initialize cart if not set
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add item to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add_to_cart') {
    $item = [
        'name' => $_POST['name'],
        'price' => $_POST['price'],
        'quantity' => $_POST['quantity'],
    ];
    array_push($_SESSION['cart'], $item);
    header("Location: " . $_SERVER['PHP_SELF'] . "?category=" . $_POST['category']);
    exit();
}

// Remove item from cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'remove_from_cart') {
    $index = $_POST['index'];
    unset($_SESSION['cart'][$index]);
    $_SESSION['cart'] = array_values($_SESSION['cart']); // Re-index the array
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// Database connection
$host = 'localhost'; // Replace with your database host
$dbname = 'food_ordering_system'; // Replace with your database name
$username = 'root'; // Replace with your database username
$password = ''; // Replace with your database password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Checkout and save order to the database
if (isset($_POST['checkout'])) {
    try {
        $pdo->beginTransaction();

        // Generate order number
        $order_number = rand(1000, 9999);

        // Calculate total price
        $total_price = 0;
        foreach ($_SESSION['cart'] as $item) {
            $total_price += $item['price'] * $item['quantity'];
        }

        // Insert into `orders` table
        $stmt = $pdo->prepare("INSERT INTO orders (order_number, total_price) VALUES (?, ?)");
        $stmt->execute([$order_number, $total_price]);

        // Get the last inserted order ID
        $order_id = $pdo->lastInsertId();

        // Insert each cart item into `order_items`
        $stmt = $pdo->prepare("INSERT INTO order_items (order_id, name, price, quantity) VALUES (?, ?, ?, ?)");
        foreach ($_SESSION['cart'] as $item) {
            $stmt->execute([$order_id, $item['name'], $item['price'], $item['quantity']]);
        }

        $pdo->commit();

        $_SESSION['order_number'] = $order_number;
        $_SESSION['cart'] = []; // Clear cart
        header("Location: receipt.php");
        exit();
    } catch (Exception $e) {
        $pdo->rollBack();
        die("Transaction failed: " . $e->getMessage());
    }
}

// Calculate total price
$total_price = 0;
foreach ($_SESSION['cart'] as $item) {
    $total_price += $item['price'] * $item['quantity'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food Ordering</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }

        header {
            background-color: #333;
            color: #fff;
            padding: 20px;
            text-align: center;
        }

        header h2 {
            font-size: 2.5rem;
        }

        footer {
            background-color: #333;
            color: #fff;
            padding: 15px;
            text-align: center;
            margin-top: auto;
        }

        nav {
            width: 250px;
            background-color: #fff;
            padding: 20px;
            box-shadow: 4px 0 10px rgba(0, 0, 0, 0.1);
            height: 100%;
            position: fixed;
            top: 80px;
        }

        nav ul {
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        nav ul li {
            font-size: 1.2rem;
        }

        nav ul li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            padding: 10px;
            background-color: #ddd;
            border-radius: 5px;
            transition: background-color 0.3s ease;
            display: block;
        }

        nav ul li a:hover {
            background-color: #6a89cc;
            color: white;
        }

        main {
            margin-left: 270px;
            padding: 20px;
            background-color: #f4f4f4;
            flex-grow: 1;
            overflow-y: auto;
        }

        .food-items {
            display: grid;
            grid-template-columns: repeat(2, 1fr); /* 2 foods per row */
            gap: 20px;
            margin-bottom: 40px;
        }

        .food-item {
            background-color: #fff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 20px;
            text-align: center;
        }

        .food-item img {
            width: 100%;
            height: 150px;
            object-fit: cover;
            margin-bottom: 10px;
        }

        .food-item h4 {
            font-size: 1.5rem;
            margin-bottom: 10px;
        }

        .food-item p {
            font-size: 1.2rem;
            margin-bottom: 10px;
        }

        .food-item input[type="number"] {
            width: 60px;
            padding: 5px;
            margin-bottom: 10px;
            text-align: center;
        }

        button {
            padding: 10px 20px;
            background-color: #6a89cc;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1rem;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #4f6fbb;
        }

        .cart {
            margin-top: 40px;
            position: fixed;
            bottom: 0;
            width: 100%;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
        }

        .cart-item {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }

        .cart-item p {
            font-size: 1.2rem;
        }

        .cart-item span {
            font-weight: bold;
        }

        .cart-total {
            font-size: 1.4rem;
            margin-top: 20px;
            font-weight: bold;
        }

        .checkout-btn {
            background-color: red;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 20px;
            position: fixed;
            bottom: 20px;
            right: 20px;
        }

        .checkout-btn:hover {
            background-color: darkred;
        }

        .cancel-btn {
            background-color: transparent;
            color: red;
            font-size: 1.5rem;
            border: none;
            cursor: pointer;
        }

        .cancel-btn:hover {
            color: darkred;
        }

        .cart-item button {
            margin-left: 10px;
            padding: 8px 12px;
        }

    </style>
</head>
<body>

<header>
    <h2>Welcome to Our Food Ordering Website</h2>
</header>

<nav>
    <ul>
        <li><a href="?category=main_dish">Main Dish</a></li>
        <li><a href="?category=side_dish">Side Dish</a></li>
        <li><a href="?category=drink">Drinks</a></li>
    </ul>
</nav>

<main>
    <?php
    if (isset($_GET['category'])) {
        $category = $_GET['category'];
        if ($category == 'main_dish') {
            include('modules/leona.php');
        } elseif ($category == 'side_dish') {
            include('modules/caamino.php');
        } elseif ($category == 'drink') {
            include('modules/pagula.php');
        }
    } else {
        echo '<h3>Select a category from the left menu</h3>';
    }
    ?>

    <div class="cart">
        <h3>Your Cart</h3>
        <?php if (count($_SESSION['cart']) > 0): ?>
            <?php foreach ($_SESSION['cart'] as $index => $item): ?>
                <div>
                    <p><?= $item['name'] ?> x <?= $item['quantity'] ?> - ₱<?= number_format($item['price'] * $item['quantity'], 2) ?></p>
                    <form method="POST" action="">
                        <input type="hidden" name="index" value="<?= $index ?>">
                        <input type="hidden" name="action" value="remove_from_cart">
                        <button type="submit">&times;</button>
                    </form>
                </div>
            <?php endforeach; ?>
            <p>Total: ₱<?= number_format($total_price, 2) ?></p>
        <?php else: ?>
            <p>Your cart is empty.</p>
        <?php endif; ?>
    </div>
</main>
<footer>
    <p>&copy; 2025 Food Ordering Website</p>
</footer>

<?php if (count($_SESSION['cart']) > 0): ?>
    <form method="POST" action="">
        <button type="submit" name="checkout" class="checkout-btn">Checkout</button>
    </form>
<?php endif; ?>
</body>
</html>
