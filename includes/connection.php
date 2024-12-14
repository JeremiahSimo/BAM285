<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "inventory_db";

// Create connection
$conn = new mysqli($servername, $username,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
?>

