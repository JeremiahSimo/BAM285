<?php
// This file will display the main dish items
?>

<div class="food-items">
    <div class="food-item">
        <img src="assets/img/caramel.webp" alt="Caramel Hazelnut Iced Coffee">
        <h4>Caramel Hazelnut Iced Coffee</h4>
        <p>150.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Caramel Hazelnut Iced Coffee">
            <input type="hidden" name="price" value="150.00">
            <input type="hidden" name="category" value="main_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="assets/img/veitnamese.jpg" alt="Vietnamese-style iced coffee">
        <h4>Vietnamese-style iced coffee</h4>
        <p>105.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Vietnamese-style iced coffee">
            <input type="hidden" name="price" value="105.00">
            <input type="hidden" name="category" value="main_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="assets/img/orangejuice.jpg" alt="Fresh orange juice">
        <h4>Fresh orange juice</h4>
        <p>99.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Fresh orange juice">
            <input type="hidden" name="price" value="50.00">
            <input type="hidden" name="category" value="main_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="assets/img/summer.jpg" alt="Summer Peach Tea Cocktail">
        <h4>Summer Peach Tea Cocktail</h4>
        <p>199.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Summer Peach Tea Cocktail">
            <input type="hidden" name="price" value="199.00">
            <input type="hidden" name="category" value="main_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
    <div class="food-item">
        <img src="assets/img/green.webp" alt="Green Dublin">
        <h4>Green Dublin</h4>
        <p>129.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Green Dublin">
            <input type="hidden" name="price" value="129.00">
            <input type="hidden" name="category" value="main_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div><div class="food-item">
        <img src="assets/img/watermelon.jpg" alt="Watermelo-Ginger mojito">
        <h4>Watermelo-Ginger mojito</h4>
        <p>179.00</p>
        <form method="POST" action="home_page.php">
            <input type="hidden" name="action" value="add_to_cart">
            <input type="hidden" name="name" value="Watermelo-Ginger mojito">
            <input type="hidden" name="price" value="179.00">
            <input type="hidden" name="category" value="main_dish">
            <input type="number" name="quantity" min="1" value="1">
            <button type="submit">Add to Cart</button>
        </form>
    </div>
</div>
</div>