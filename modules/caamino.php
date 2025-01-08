<?php
// This file will display the side dish items
?>

<div class="food-items">
    <div class="food-item">
        <img src="path/to/jolly_crispy_fries_regular.jpg" alt="Jolly Crispy Fries (Regular)">
        <h4>Jolly Crispy Fries (Regular)</h4>
        <p>₱40</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Jolly Crispy Fries (Regular)">
            <input type="hidden" name="price" value="40">
            <input type="hidden" name="category" value="side_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="path/to/jolly_crispy_fries_large.jpg" alt="Jolly Crispy Fries (Large)">
        <h4>Jolly Crispy Fries (Large)</h4>
        <p>₱65</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Jolly Crispy Fries (Large)">
            <input type="hidden" name="price" value="65">
            <input type="hidden" name="category" value="side_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="path/to/mashed_potatoes_regular.jpg" alt="Mashed Potatoes (Regular)">
        <h4>Mashed Potatoes (Regular)</h4>
        <p>₱35</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Mashed Potatoes (Regular)">
            <input type="hidden" name="price" value="35">
            <input type="hidden" name="category" value="side_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="path/to/mashed_potatoes_large.jpg" alt="Mashed Potatoes (Large)">
        <h4>Mashed Potatoes (Large)</h4>
        <p>₱50</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Mashed Potatoes (Large)">
            <input type="hidden" name="price" value="50">
            <input type="hidden" name="category" value="side_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="path/to/steamed_rice.jpg" alt="Steamed Rice">
        <h4>Steamed Rice</h4>
        <p>₱25</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Steamed Rice">
            <input type="hidden" name="price" value="25">
            <input type="hidden" name="category" value="side_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="path/to/adobo_rice.jpg" alt="Adobo Rice">
        <h4>Adobo Rice</h4>
        <p>₱35</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Adobo Rice">
            <input type="hidden" name="price" value="35">
            <input type="hidden" name="category" value="side_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="path/to/side_jolly_spaghetti.jpg" alt="Side Jolly Spaghetti">
        <h4>Side Jolly Spaghetti</h4>
        <p>₱50</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Side Jolly Spaghetti">
            <input type="hidden" name="price" value="50">
            <input type="hidden" name="category" value="side_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="path/to/extra_gravy.jpg" alt="Extra Large Gravy">
        <h4>Extra Large Gravy</h4>
        <p>₱10</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Extra Gravy">
            <input type="hidden" name="price" value="10">
            <input type="hidden" name="category" value="side_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</div>

