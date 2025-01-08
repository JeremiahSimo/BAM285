<?php
// This file will display the main dish items
?>

<div class="food-items">
    <div class="food-item">
        <img src="assets/img/chicken.jpg" alt="Chicken">
        <h4>Chicken</h4>
        <p>99.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Chicken">
            <input type="hidden" name="price" value="99.00">
            <input type="hidden" name="category" value="main_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="assets/img/pasta.webp" alt="Pasta">
        <h4>Pasta</h4>
        <p>105.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Pasta">
            <input type="hidden" name="price" value="105.00">
            <input type="hidden" name="category" value="main_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</div>
