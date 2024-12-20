<?php
// Start the session to handle any session data (if required)

// Database connection details
$host = "localhost";  // Your database server, usually localhost
$username = "root";   // Your MySQL username (default is "root")
$password = "";       // Your MySQL password (default is empty on localhost)
$database = "inventory_db";  // Your database name (ensure this matches the DB you created)

// Create a new MySQLi connection
$conn = new mysqli($host, $username, $password, $database);

// Check if the connection was successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize form data
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);
    $reservation_date = $conn->real_escape_string($_POST['reservation_date']);
    $num_people = $conn->real_escape_string($_POST['num_people']);
    $special_requests = $conn->real_escape_string($_POST['special_requests']);

    // Prepare the SQL query to insert data into the reservation_form table
    $query = "INSERT INTO lusdoc_form (name, email, phone, reservation_date, num_people, special_requests, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, NOW())";

    // Prepare the statement
    if ($stmt = $conn->prepare($query)) {
        // Bind parameters (s = string, i = integer, d = double, b = blob)
        $stmt->bind_param("ssssss", $name, $email, $phone, $reservation_date, $num_people, $special_requests);

        // Execute the query and check for success
        if ($stmt->execute()) {
            echo "<p>Reservation successfully made!</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "<p>Error preparing the statement: " . $conn->error . "</p>";
    }
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation Form</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        .form-container {
            background-color: #fff;
            padding: 40px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin-bottom: 30px;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }

        label {
            font-size: 16px;
            color: #555;
            margin-bottom: 8px;
            display: block;
        }

        input[type="text"],
        input[type="email"],
        input[type="date"],
        input[type="tel"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
        }

        textarea {
            resize: vertical;
            height: 100px;
        }

        button {
            background-color: #4CAF50;
            color: #fff;
            padding: 12px 20px;
            border: none;
            border-radius: 4px;
            width: 100%;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        button:hover {
            background-color: #45a049;
        }

        /* Footer Style */
        footer {
            text-align: center;
            color: #777;
            font-size: 14px;
            margin-top: 30px;
            padding: 20px 0;
            width: 100%;
            background-color: #f1f1f1;
        }

        footer a {
            color: #4CAF50;
            text-decoration: none;
        }

        /* Responsive design for smaller screens */
        @media (max-width: 600px) {
            .form-container {
                padding: 20px;
                width: 90%;
            }
            button {
                font-size: 14px;
            }
        }
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Reservation Form</h2>

        <!-- Reservation form -->
        <form method="POST" action="index_admin.php?page=lusdoc_form">
            <div class="form-group">
                <label for="name">Full Name:</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>
            </div>

            <div class="form-group">
                <label for="phone">Phone Number:</label>
                <input type="tel" name="phone" id="phone" required>
            </div>

            <div class="form-group">
                <label for="reservation_date">Reservation Date:</label>
                <input type="date" name="reservation_date" id="reservation_date" required>
            </div>

            <div class="form-group">
                <label for="num_people">Number of People:</label>
                <input type="number" name="num_people" id="num_people" required min="1">
            </div>

            <div class="form-group">
                <label for="special_requests">Special Requests:</label>
                <textarea name="special_requests" id="special_requests"></textarea>
            </div>

            <button type="submit">Make Reservation</button>
        </form>
    </div>

    <!-- Footer with copyright and design credits -->
    <footer>
        <p>&copy; 2024 Copyright ReservationApp. All Rights Reserved. | Designed by <a href="https://bootstrapmade.com/" target="_blank">BootstrapMade</a></p>
    </footer>

</body>
</html>
