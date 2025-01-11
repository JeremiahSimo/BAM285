<?php
// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Database credentials
$servername = "localhost";  // Change this if your DB is hosted elsewhere
$username = "root";         // Change this if needed
$password = "";             // Add your password if set
$dbname = "forms_db";       // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
$firstname = $conn->real_escape_string($_POST['Firstname']);
$surname = $conn->real_escape_string($_POST['Surname']);
$birthdate = $conn->real_escape_string($_POST['Birthdate']);
$street = $conn->real_escape_string($_POST['Street']);
$city = $conn->real_escape_string($_POST['City']);
$mobile = $conn->real_escape_string($_POST['Mobile']);

// Prepare SQL query
$sql = "INSERT INTO applications (Firstname, Surname, Birthdate, Street, City, Mobile) 
        VALUES ('$firstname', '$surname', '$birthdate', '$street', '$city', '$mobile')";

// Execute query and check for success
if ($conn->query($sql) === TRUE) {
    echo "Application submitted successfully!";
} else {
    echo "Error: " . $conn->error;  // Show the detailed error if any
}

// Close connection
$conn->close();
?>
