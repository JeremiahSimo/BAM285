<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "forms_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get form data
$Firstname= $_POST['Firstname'];
$Surname= $_POST['Surname'];
$Birthdate= $_POST['Birthdate'];
$Street=$_POST['Street'];
$City=$_POST['City'];
$Mobile=$_POST['Mobile'];

// Insert data into database
$sql = "INSERT INTO job_app_tbl(firstname, surname, birthdate, street, city, mobile) 
        VALUES ('$Firstname','$Surname','$Birthdate','$Street','$City','$Mobile')";

if ($conn->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
