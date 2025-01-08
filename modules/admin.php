<?php
session_start();
require_once 'C:/xampp/htdocs/pitpit/BAM285/includes/connection.php';


// Functions

// Add Category
function addCategory($category_name, $conn) {
    $sql = "INSERT INTO categories (name) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $category_name);
    return $stmt->execute();
}

// Add Food
function addFood($food_name, $food_price, $category_id, $conn) {
    $sql = "INSERT INTO foods (name, price, category_id) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdi", $food_name, $food_price, $category_id);
    return $stmt->execute();
}

// Update Food
function updateFood($food_id, $food_name, $food_price, $category_id, $conn) {
    $sql = "UPDATE foods SET name = ?, price = ?, category_id = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sdii", $food_name, $food_price, $category_id, $food_id);
    return $stmt->execute();
}

// Delete Food
function deleteFood($food_id, $conn) {
    $sql = "DELETE FROM foods WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $food_id);
    return $stmt->execute();
}

// Add Order
function addOrder($order_number, $food_items, $conn) {
    $sql = "INSERT INTO orders (order_number) VALUES (?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $order_number);
    $stmt->execute();
    $order_id = $stmt->insert_id;

    foreach ($food_items as $food_id => $quantity) {
        $sql = "INSERT INTO order_items (order_id, food_id, quantity) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("iii", $order_id, $food_id, $quantity);
        $stmt->execute();
    }
}

// Calculate Total Sales
function getTotalSales($conn) {
    $sql = "SELECT SUM(oi.quantity * f.price) AS total_sales FROM order_items oi
            JOIN foods f ON oi.food_id = f.id";
    $result = $conn->query($sql);
    return $result->fetch_assoc()['total_sales'];
}

// Calculate Total Customers
function getTotalCustomers($conn) {
    $sql = "SELECT COUNT(DISTINCT o.order_number) AS total_customers FROM orders o";
    $result = $conn->query($sql);
    return $result->fetch_assoc()['total_customers'];
}

// Fetch All Categories
function getCategories($conn) {
    $sql = "SELECT * FROM categories";
    return $conn->query($sql);
}

// Fetch All Foods
function getFoods($conn) {
    $sql = "SELECT f.id, f.name, f.price, c.name AS category_name FROM foods f
            JOIN categories c ON f.category_id = c.id";
    return $conn->query($sql);
}

// Fetch All Orders
function getOrders($conn) {
    $sql = "SELECT * FROM orders";
    return $conn->query($sql);
}

// Handle Form Submissions

if (isset($_POST['add_category'])) {
    addCategory($_POST['category_name'], $conn);
}

if (isset($_POST['add_food'])) {
    addFood($_POST['food_name'], $_POST['food_price'], $_POST['category_id'], $conn);
}

if (isset($_POST['update_food'])) {
    updateFood($_POST['food_id'], $_POST['food_name'], $_POST['food_price'], $_POST['category_id'], $conn);
}

if (isset($_POST['delete_food'])) {
    deleteFood($_POST['food_id'], $conn);
}

if (isset($_POST['add_order'])) {
    addOrder($_POST['order_number'], $_POST['food_items'], $conn);
}

$total_sales = getTotalSales($conn);
$total_customers = getTotalCustomers($conn);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel</title>
</head>
<body>
    <h1>Admin Panel</h1>

    <!-- Add Category Form -->
    <h2>Add Category</h2>
    <form method="post">
        <label>Category Name: </label><input type="text" name="category_name" required><br>
        <button type="submit" name="add_category">Add Category</button>
    </form>

    <!-- Add Food Form -->
    <h2>Add Food</h2>
    <form method="post">
        <label>Food Name: </label><input type="text" name="food_name" required><br>
        <label>Food Price: </label><input type="number" name="food_price" required><br>
        <label>Category: </label>
        <select name="category_id" required>
            <?php
            $categories = getCategories($conn);
            while ($category = $categories->fetch_assoc()) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
            }
            ?>
        </select><br>
        <button type="submit" name="add_food">Add Food</button>
    </form>

    <!-- Update Food Form -->
    <h2>Update Food</h2>
    <form method="post">
        <label>Food ID: </label><input type="number" name="food_id" required><br>
        <label>Food Name: </label><input type="text" name="food_name" required><br>
        <label>Food Price: </label><input type="number" name="food_price" required><br>
        <label>Category: </label>
        <select name="category_id" required>
            <?php
            $categories = getCategories($conn);
            while ($category = $categories->fetch_assoc()) {
                echo "<option value='{$category['id']}'>{$category['name']}</option>";
            }
            ?>
        </select><br>
        <button type="submit" name="update_food">Update Food</button>
    </form>

    <!-- Delete Food Form -->
    <h2>Delete Food</h2>
    <form method="post">
        <label>Food ID: </label><input type="number" name="food_id" required><br>
        <button type="submit" name="delete_food">Delete Food</button>
    </form>

    <!-- Add Order Form -->
    <h2>Add Order</h2>
    <form method="post">
        <label>Order Number: </label><input type="text" name="order_number" required><br>
        <h3>Food Items</h3>
        <div id="food_items">
            <div>
                <label>Food ID: </label><input type="number" name="food_items[1]" required><br>
                <label>Quantity: </label><input type="number" name="food_items[1_quantity]" required><br>
            </div>
        </div>
        <button type="submit" name="add_order">Add Order</button>
    </form>

    <!-- Statistics -->
    <h2>Statistics</h2>
    <p>Total Sales: $<?php echo number_format($total_sales, 2); ?></p>
    <p>Total Customers: <?php echo $total_customers; ?></p>

    <!-- Category List -->
    <h2>Category List</h2>
    <table border="1">
        <tr>
            <th>Category ID</th>
            <th>Category Name</th>
        </tr>
        <?php
        $categories = getCategories($conn);
        while ($category = $categories->fetch_assoc()) {
            echo "<tr>
                    <td>{$category['id']}</td>
                    <td>{$category['name']}</td>
                </tr>";
        }
        ?>
    </table>

    <!-- Food List -->
    <h2>Food List</h2>
    <table border="1">
        <tr>
            <th>Food ID</th>
            <th>Food Name</th>
            <th>Price</th>
            <th>Category</th>
        </tr>
        <?php
        $foods = getFoods($conn);
        while ($food = $foods->fetch_assoc()) {
            echo "<tr>
                    <td>{$food['id']}</td>
                    <td>{$food['name']}</td>
                    <td>\${$food['price']}</td>
                    <td>{$food['category_name']}</td>
                </tr>";
        }
        ?>
    </table>

    <!-- Orders List -->
    <h2>Orders List</h2>
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Order Number</th>
            <th>Order Date</th>
        </tr>
        <?php
        $orders = getOrders($conn);
        while ($order = $orders->fetch_assoc()) {
            echo "<tr>
                    <td>{$order['id']}</td>
                    <td>{$order['order_number']}</td>
                    <td>{$order['order_date']}</td>
                </tr>";
        }
        ?>
    </table>

</body>
</html>

<?php
$conn->close(); // Close the database connection
?>
