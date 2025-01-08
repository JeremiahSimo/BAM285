<?php
// This file will display the side dish items
?>

<div class="food-items">
    <div class="food-item">
        <img src="path/to/fries.jpg" alt="Fries">
        <h4>Fries</h4>
        <p>$3.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Fries">
            <input type="hidden" name="price" value="3.00">
            <input type="hidden" name="category" value="side_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="path/to/salad.jpg" alt="Salad">
        <h4>Salad</h4>
        <p>$5.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Salad">
            <input type="hidden" name="price" value="5.00">
            <input type="hidden" name="category" value="side_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</div>
