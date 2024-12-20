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
    $department = $conn->real_escape_string($_POST['department']);
    $position = $conn->real_escape_string($_POST['position']);
    $date_of_joining = $conn->real_escape_string($_POST['date_of_joining']);

    // Prepare the SQL query to insert data into the ivan_form table
    $query = "INSERT INTO ivan_form (name, email, phone, department, position, date_of_joining, created_at) 
              VALUES (?, ?, ?, ?, ?, ?, NOW())";

    // Prepare the statement
    if ($stmt = $conn->prepare($query)) {
        // Bind parameters (s = string, i = integer, d = double, b = blob)
        $stmt->bind_param("ssssss", $name, $email, $phone, $department, $position, $date_of_joining);

        // Execute the query and check for success
        if ($stmt->execute()) {
            echo "<p>Employee registered successfully!</p>";
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
    <title>Employee Registration</title>
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
        input[type="tel"] {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            color: #333;
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
        <h2>Employee Registration</h2>

        <!-- Employee registration form -->
        <form method="POST" action="index_admin.php?page=ivan_form">
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
                <label for="department">Department:</label>
                <input type="text" name="department" id="department" required>
            </div>

            <div class="form-group">
                <label for="position">Position:</label>
                <input type="text" name="position" id="position" required>
            </div>

            <div class="form-group">
                <label for="date_of_joining">Date of Joining:</label>
                <input type="date" name="date_of_joining" id="date_of_joining" required>
            </div>

            <button type="submit">Register Employee</button>
        </form>
    </div>

    <!-- Footer with copyright and design credits -->
    <footer>
        <p>&copy; 2024 Copyright NiceAdmin. All Rights Reserved. | Designed by <a href="https://bootstrapmade.com/" target="_blank">BootstrapMade</a></p>
    </footer>

</body>
</html>
