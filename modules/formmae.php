<?php
include "includes/connection.php";

if (isset($_POST["btn_submit"])) {
    // Sanitize and capture the form inputs
    $name = $_POST["name"];
    $email = $_POST["email"];
    $number = $_POST["number"];
    $program = $_POST["program"];
    $level = $_POST["level"];
    $specialization = $_POST["specialization"];
    $created_at = date('Y-m-d H:i:s'); // Get the current timestamp

    // Prepare the SQL query
    $sql = "INSERT INTO students (name, email, number, program, level, specialization, created_at) 
            VALUES ('$name', '$email', '$number', '$program', '$level', '$specialization', '$created_at')";

    // Execute the query and check for success
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Students Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        form {
            max-width: 400px;
            margin: auto;
            background: #f9f9f9;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin: 10px 0 5px;
        }
        input[type="text"], input[type="email"], input[type="number"], button {
            width: 100%;
            padding: 10px;
            margin: 5px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            border: none;
            cursor: pointer;
            padding: 10px;
            border-radius: 4px;
        }
        button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>

<h2 style="text-align: center;">New Students Form</h2>
<form action="" method="post" action="index_admin.php?page=formmae">

    <label for="name">Full Name:</label>
    <input type="text" id="name" name="name" placeholder="Enter your name" required>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" placeholder="Enter your email" required>

    <label for="number">Mobile Number:</label>
    <input type="number" id="number" name="number" placeholder="Enter your phone number" required>

    <label for="program">Program:</label>
    <input type="text" id="program" name="program" placeholder="Enter your program" required>

    <label for="level">Year Level:</label>
    <input type="text" id="level" name="level" placeholder="Enter your year level" required>

    <label for="specialization">Specialization:</label>
    <input type="text" id="specialization" name="specialization" placeholder="Enter your specialization" required>

    <button type="submit" name="btn_submit">Submit</button>
</form>

</body>
</html>
