<?php
// Include the database connection
include 'connect2.php'; // Make sure this file contains the MySQL connection logic

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $full_name = $_POST['full_name'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    // Insert data into the database
    $sql = "INSERT INTO contact_us (full_name, email, subject, message) 
            VALUES ('$full_name', '$email', '$subject', '$message')";

    // Check if the query was successful
    if (mysqli_query($conn, $sql)) {
        echo "Message sent successfully!";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>
