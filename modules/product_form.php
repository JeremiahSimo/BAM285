<?php
include "includes/connection.php";

if (isset($_POST["btn_submit"])) {
    $product_name = $_POST["product_name"];
    $product_price = $_POST["product_price"];
    $product_quantity = $_POST["product_quantity"];

    $sql = "INSERT INTO product_inventory (product_name, product_price, product_quantity) 
            VALUES ('$product_name', '$product_price', '$product_quantity')";

    if ($conn->query($sql) === TRUE) {
        echo "New product record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Registration</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Update with your Bootstrap path -->
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-4">Product Registration Form</h2>
        <form class="row g-3" method="POST" action="index_admin.php?page=product_registration_form">
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control" id="productName" name="product_name" placeholder="Product Name" required>
                    <label for="productName">Product Name</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="number" class="form-control" id="productPrice" name="product_price" placeholder="Product Price" step="0.01" required>
                    <label for="productPrice">Product Price</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="number" class="form-control" id="productQuantity" name="product_quantity" placeholder="Product Quantity" required>
                    <label for="productQuantity">Product Quantity</label>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" name="btn_submit" class="btn btn-primary">Register</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
</body>
</html>
