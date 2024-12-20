
    <style>
        /* Universal Reset */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        h1 {
            font-size: 2.5em;
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        .form-container {
            background: #fff;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 600px; /* Center and limit form width */
            padding: 30px;
            box-sizing: border-box;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        fieldset {
            border: none;
            width: 100%;
            padding: 0;
        }

        legend {
            font-size: 1.3em;
            color: #333;
            margin-bottom: 10px;
            font-weight: bold;
        }

        label {
            font-size: 1em;
            color: #555;
            margin-bottom: 5px;
            text-align: left;
        }

        input[type="text"], input[type="email"], input[type="number"], textarea, select {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            font-size: 1em;
            background-color: #fafafa;
            transition: border-color 0.3s ease-in-out;
        }

        input[type="text"]:focus, input[type="email"]:focus, input[type="number"]:focus, textarea:focus, select:focus {
            border-color: #007BFF;
            outline: none;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        input[type="submit"] {
            padding: 15px;
            background-color: #28a745;
            color: #fff;
            font-size: 1.2em;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease-in-out;
        }

        input[type="submit"]:hover {
            background-color: #218838;
        }

        input[type="submit"]:active {
            background-color: #1e7e34;
        }

        input[type="submit"]:focus {
            outline: none;
        }

        /* Responsive Design: Small screens */
        @media screen and (max-width: 600px) {
            .form-container {
                padding: 20px;
            }

            h1 {
                font-size: 2em;
            }

            input[type="submit"] {
                font-size: 1.1em;
            }
        }
    </style>

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


