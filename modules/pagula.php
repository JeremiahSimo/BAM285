<?php
// This file will display the drink items
?>

<div class="food-items">
    <div class="food-item">
        <img src="path/to/cola.jpg" alt="Cola">
        <h4>Cola</h4>
        <p>21.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Cola">
            <input type="hidden" name="price" value="2.00">
            <input type="hidden" name="category" value="drink">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="path/to/juice.jpg" alt="Juice">
        <h4>Juice</h4>
        <p>35.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Juice">
            <input type="hidden" name="price" value="3.50">
            <input type="hidden" name="category" value="drink">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</div>
