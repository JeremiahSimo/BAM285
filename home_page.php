<!DOCTYPE html>
<html lang="en">
<head>
  <title>Product Dashboard - Furniture, Clothing, Toys</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    /* Your existing CSS */
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
    }

    body {
      font-family: 'Roboto', sans-serif;
      line-height: 1.6;
      color: #333;
      background: url('assets/img/background_photo.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      flex-direction: column;
      min-height: 100vh;
    }

    main {
      flex: 1;
    }

    header {
      background: linear-gradient(135deg, #333, #666);
      color: white;
      padding: 30px;
      text-align: center;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
      position: relative;
    }

    header h2 {
      font-size: 2.8rem;
      margin-bottom: 10px;
    }

    header p {
      font-size: 1.4rem;
    }

    .cart {
      position: absolute;
      top: 20px;
      right: 20px;
      font-size: 2rem;
      color: white;
      cursor: pointer;
    }

    .cart span {
      background: red;
      color: white;
      border-radius: 50%;
      padding: 5px 15px;
      margin-left: 5px;
      font-size: 1.2rem;
    }

    header + main {
      margin-top: 30px;
    }

    nav {
      float: left;
      width: 25%;
      background: #ffffff;
      padding: 25px;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    }

    nav ul {
      list-style: none;
    }

    nav ul li {
      margin-bottom: 20px;
    }

    nav ul li a {
      text-decoration: none;
      color: #333;
      font-size: 1.3rem;
      font-weight: bold;
      transition: color 0.3s ease;
    }

    nav ul li a:hover {
      color: #6a89cc;
    }

    nav ul li.dashboard {
      font-size: 1.6rem;
      font-weight: bold;
      color: #333;
    }

    article {
      float: left;
      width: 70%;
      background: #ffffff;
      padding: 30px;
      margin-left: 5%;
      border-radius: 10px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      min-height: 400px;
    }

    .product-box {
      display: flex;
      flex-wrap: wrap;
      gap: 20px;
    }

    .product-item {
      width: calc(33.33% - 20px);
      background: #ffffff;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      text-align: center;
      transition: transform 0.3s ease;
    }

    .product-item:hover {
      transform: translateY(-5px);
    }

    .product-item img {
      max-width: 100%;
      height: auto;
      border-radius: 10px;
      margin-bottom: 10px;
    }

    .product-item h3 {
      font-size: 1.5rem;
      margin: 10px 0;
    }

    .product-item p {
      font-size: 1.2rem;
      color: #666;
    }

    .product-item button {
      background: #6a89cc;
      color: white;
      border: none;
      padding: 12px 20px;
      border-radius: 5px;
      cursor: pointer;
      transition: background 0.3s ease;
      font-size: 1.1rem;
    }

    .product-item button:hover {
      background: #a29bfe;
    }

    .cart-modal {
      display: none;
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 30px;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3);
      z-index: 9999;
      max-width: 500px;
      width: 100%;
    }

    .cart-modal h3 {
      font-size: 2rem;
      margin-bottom: 20px;
    }

    .cart-modal .close-btn {
      position: absolute;
      top: 10px;
      right: 10px;
      background: red;
      color: white;
      border: none;
      border-radius: 50%;
      width: 30px;
      height: 30px;
      font-size: 1.2rem;
      cursor: pointer;
    }

    .cart-modal .close-btn:hover {
      background: darkred;
    }

    .cart-modal p {
      font-size: 1.2rem;
      margin-bottom: 20px;
    }

    footer {
      background: #333;
      color: white;
      text-align: center;
      padding: 15px;
      margin-top: auto;
    }

  </style>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>
    let cart = JSON.parse(localStorage.getItem("cart")) || [];
    let cartCount = cart.length;
    let cartTotal = JSON.parse(localStorage.getItem("cartTotal")) || 0;

    function updateCartCount() {
      document.getElementById("cart-count").textContent = cartCount;
    }

    function addToCart(itemName, itemPrice) {
      cart.push({name: itemName, price: itemPrice});
      cartCount++;
      cartTotal += itemPrice;

      localStorage.setItem("cart", JSON.stringify(cart));
      localStorage.setItem("cartTotal", JSON.stringify(cartTotal));

      updateCartCount();
      alert(itemName + " added to cart successfully!");

      updateCartInDatabase();
    }

    function removeItemFromCart(index) {
      const itemPrice = cart[index].price;
      cart.splice(index, 1);
      cartCount--;
      cartTotal -= itemPrice;

      localStorage.setItem("cart", JSON.stringify(cart));
      localStorage.setItem("cartTotal", JSON.stringify(cartTotal));

      updateCartCount();
      viewCart();
      updateCartInDatabase();
    }

    function updateCartInDatabase() {
      $.ajax({
        url: 'update_cart.php',
        method: 'POST',
        data: {
          cart: JSON.stringify(cart),
          cartTotal: cartTotal
        },
        success: function(response) {
          console.log("Cart updated in database:", response);
        },
        error: function(xhr, status, error) {
          console.error("Error updating cart in database:", error);
        }
      });
    }

    function viewCart() {
      const cartModal = document.getElementById("cart-modal");
      const cartItemsContainer = document.getElementById("cart-items");

      if (cartCount === 0) {
        alert("Your cart is empty.");
        return;
      }

      cartItemsContainer.innerHTML = "";
      cart.forEach((item, index) => {
        const cartItemDiv = document.createElement("div");
        cartItemDiv.classList.add("item");
        cartItemDiv.innerHTML = `
          <span>${item.name} - $${item.price}</span>
          <button onclick="removeItemFromCart(${index})">Delete</button>
        `;
        cartItemsContainer.appendChild(cartItemDiv);
      });

      document.getElementById("cart-total-price").textContent = `$${cartTotal.toFixed(2)}`;
      cartModal.style.display = "block";
    }

    function closeCart() {
      document.getElementById("cart-modal").style.display = "none";
    }

    function checkout() {
      alert("Proceeding to checkout...");
    }

    window.onload = updateCartCount;
  </script>
</head>
<body>

<header>
  <h2>Welcome to Our Product Dashboard</h2>
  <p>Explore a wide range of Furniture, Clothing, and Toys</p>
  <div class="cart" onclick="viewCart()">
    🛒 Cart <span id="cart-count">0</span>
  </div>
</header>

<main>
  <section>
    <nav>
      <ul>
        <li class="dashboard">Dashboard</li>
        <li><a href="home_page.php?product=furniture">Furniture</a></li>
        <li><a href="home_page.php?product=clothing">Clothing</a></li>
        <li><a href="home_page.php?product=toys">Toys</a></li>
      </ul>
    </nav>

    <article>
      <?php
      if (isset($_GET['product'])) {
          $product = htmlspecialchars($_GET['product']);
          switch ($product) {
              case 'furniture':
                  include 'modules/leona.php';
                  break;
              case 'clothing':
                  include 'modules/caamino.php';
                  break;
              case 'toys':
                  include 'modules/pagula.php';
                  break;
              default:
                  echo "<p>Invalid product selection. Please choose a valid category.</p>";
          }
      } else {
          echo "<p>Select a category from the left menu to explore our products!</p>";
      }
      ?>
    </article>
  </section>
</main>

<div id="cart-modal" class="cart-modal">
  <button class="close-btn" onclick="closeCart()">×</button>
  <h3>Your Cart</h3>
  <div id="cart-items"></div>
  <p>Total: <span id="cart-total-price"></span></p>
  <button style="background-color: red; color: white; border: none; padding: 12px 20px; border-radius: 5px; cursor: pointer;" onclick="checkout()">Proceed to Checkout</button>
</div>

<footer>
  <p>&copy; 2025 Product Dashboard | All Rights Reserved</p>
</footer>

</body>
</html>
