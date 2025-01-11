<?php
// Database connection setup
$servername = "localhost";
$username = "root"; // Replace with your MySQL username
$password = "";     // Replace with your MySQL password
$dbname = "forms_db"; // Replace with your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $firstname = $_POST['Firstname'];
    $surname = $_POST['Surname'];
    $birthdate = $_POST['Birthdate'];
    $street = $_POST['Street'];
    $city = $_POST['City'];
    $mobile = $_POST['Mobile'];

    // SQL query to insert form data into the 'applications' table
    $sql = "INSERT INTO applications (Firstname, Surname, Birthdate, Street, City, Mobile)
            VALUES ('$firstname', '$surname', '$birthdate', '$street', '$city', '$mobile')";

    if ($conn->query($sql) === TRUE) {
        echo "New application submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the connection
    $conn->close();
}
?>
