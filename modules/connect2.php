<?php
// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Database connection
    $conn = new mysqli('localhost', 'root', '', 'forms_db');

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect and sanitize form data
    $full_name = $conn->real_escape_string($_POST['full_name']);
    $email = $conn->real_escape_string($_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);  // Secure password hashing
    $gender = $conn->real_escape_string($_POST['gender']);
    $age = (int)$_POST['age'];
    $bio = $conn->real_escape_string($_POST['bio']);

    // Insert the data into the database
    $sql = "INSERT INTO users (full_name, email, password, gender, age, bio) 
            VALUES ('$full_name', '$email', '$password', '$gender', $age, '$bio')";

    if ($conn->query($sql) === TRUE) {
        echo "Registration successful! You can now log in.";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>