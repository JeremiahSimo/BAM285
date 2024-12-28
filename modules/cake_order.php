

        <h1>Cake Order Form</h1>
        <form action="process_order.php" method="POST">
            <!-- Customer Details -->
            <fieldset>
                <legend>Customer Details</legend>
                <label for="customer_name">Name:</label>
                <input type="text" id="customer_name" name="customer_name" required><br><br>

                <label for="phone_number">Phone Number:</label>
                <input type="text" id="phone_number" name="phone_number" required><br><br>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email"><br><br>

                <label for="address">Address:</label><br>
                <textarea id="address" name="address" rows="4" cols="50" required></textarea><br><br>
            </fieldset>

            <!-- Cake Selection -->
            <fieldset>
                <legend>Select Your Cake</legend>

                <label for="cake_id">Cake:</label>
                <select id="cake_id" name="cake_id" required>
                    <option value="1">Chocolate Cake</option>
                    <option value="2">Vanilla Cake</option>
                    <option value="3">Red Velvet Cake</option>
                </select><br><br>

                <label for="quantity">Quantity:</label>
                <input type="number" id="quantity" name="quantity" min="1" required><br><br>
            </fieldset>

            <!-- Order Submission -->
            <input type="submit" value="Place Order">
        </form>


