<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forms_db";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form inputs
    $name = mysqli_real_escape_string($conn, $_POST['rsv_name']);
    $email = mysqli_real_escape_string($conn, $_POST['rsv_email']);
    $phone = mysqli_real_escape_string($conn, $_POST['rsv_phone']);
    $date = mysqli_real_escape_string($conn, $_POST['rsv_date']);
    $time = mysqli_real_escape_string($conn, $_POST['rsv_time']);

    // Insert data into the database
    $sql = "INSERT INTO reservation_form (rsv_name, rsv_email, rsv_phone, rsv_date, rsv_time) 
            VALUES ('$name', '$email', '$phone', '$date', '$time')";

    if (mysqli_query($conn, $sql)) {
        echo "Reservation submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the connection
    mysqli_close($conn);
}
?>
