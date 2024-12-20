<?php

$servername = "localhost";
$username = "root";
$password = "";
$database = "form_db";


$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $email = $_POST['email'];
    $birth_date = $_POST['birth_date'];
    $passport_type = $_POST['passport_type'];

    
    if (empty($first_name) || empty($last_name) || empty($email) || empty($birth_date) || empty($passport_type)) {
        echo "<div class='error'>All fields are required!</div>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<div class='error'>Invalid email format!</div>";
    } else {
        
        $stmt = $conn->prepare("INSERT INTO applications (first_name, last_name, email, birth_date, passport_type) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $first_name, $last_name, $email, $birth_date, $passport_type);

        if ($stmt->execute()) {
            echo "<div class='success'>Application submitted successfully!</div>";
        } else {
            echo "<div class='error'>Error: " . $stmt->error . "</div>";
        }

        
        $stmt->close();
    }
}


$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Passport Application</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(to right, #6a11cb, #2575fc);
            color: #fff;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background: rgba(255, 255, 255, 0.1);
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        form label {
            display: block;
            margin: 10px 0 5px;
            font-weight: bold;
        }

        form input, form select, form button {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: none;
            border-radius: 5px;
        }

        form input, form select {
            background: #fff;
            color: #333;
        }

        form button {
            background: #2575fc;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        form button:hover {
            background: #1a5edc;
        }

        .error {
            background: #e74c3c;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        .success {
            background: #2ecc71;
            padding: 10px;
            text-align: center;
            margin-bottom: 20px;
            border-radius: 5px;
        }

        @media (max-width: 600px) {
            .container {
                margin: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Passport Application Form</h2>
        <form method="POST" action="">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" required>

            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="birth_date">Birth Date:</label>
            <input type="date" id="birth_date" name="birth_date" required>

            <label for="passport_type">Passport Type:</label>
            <select id="passport_type" name="passport_type" required>
                <option value="Regular">Regular</option>
                <option value="Official">Official</option>
                <option value="Diplomatic">Diplomatic</option>
            </select>

            <button type="submit">Submit Application</button>
        </form>
    </div>
</body>
</html>
