<?php
 
 if(isset($_POST["submit"])){
    $Firstname = $_POST["Firstname"];
$Surname = $_POST["Surname"];
$Birthdate = $_POST["Birthdate"];
$Street = $_POST["Street"];
$City = $_POST["City"];
$Mobile = $_POST["Mobile"];


    $sql = "INSERT INTO  job_app_tbl    (Firstname, Surname, Birthdate, Street, City, Mobile)
VALUES ('$Firstname','$Surname','$Birthdate','$Street','$City','$Mobile')";

if ($conn->query($sql) === TRUE) {
  echo "New record created successfully";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
 }

?>


