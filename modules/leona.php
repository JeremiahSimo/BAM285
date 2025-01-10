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
    <div class="food-item">
        <img src="assets/img/steak.webp" alt="Chicken">
        <h4>Steak</h4>
        <p>259.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Steak">
            <input type="hidden" name="price" value="259.00">
            <input type="hidden" name="category" value="main_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="assets/img/turkishpasta.webp" alt="Chicken">
        <h4>Turkish Pasta</h4>
        <p>199.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Turkish Pasta">
            <input type="hidden" name="price" value="199.00">
            <input type="hidden" name="category" value="main_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="assets/img/pizzarice.webp" alt="Chicken">
        <h4>Pizza Rice</h4>
        <p>129.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Pizza Rice">
            <input type="hidden" name="price" value="129.00">
            <input type="hidden" name="category" value="main_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div><div class="food-item">
        <img src="assets/img/frenchonionbeef.webp" alt="Chicken">
        <h4>French Onion Beef</h4>
        <p>179.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="French Onion Beef">
            <input type="hidden" name="price" value="179.00">
            <input type="hidden" name="category" value="main_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</div>
