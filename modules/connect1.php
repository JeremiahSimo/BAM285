<?php
// Database credentials
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = ""; // Your MySQL password
$dbname = "forms_db"; // The name of your database

// Create a connection to MySQL database
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize input values to prevent SQL injection
    $name = mysqli_real_escape_string($conn, $_POST['rf_name']);
    $email = mysqli_real_escape_string($conn, $_POST['rf_email']);
    $company = mysqli_real_escape_string($conn, $_POST['rf_company']);
    $phone = mysqli_real_escape_string($conn, $_POST['rf_phone']);
    
    // Prepare the SQL query to insert data
    $sql = "INSERT INTO file_request(rf_name, rf_email, rf_company, rf_phone) VALUES ('$name', '$email', '$company', '$phone')";

    // Check if the query is successful
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close the database connection
$conn->close();
?>
