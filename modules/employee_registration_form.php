<?php
include "includes/connection.php";

if (isset($_POST["btn_submit"])) {
    $employee_name = $_POST["employee_name"];
    $employee_email = $_POST["employee_email"];
    $employee_position = $_POST["employee_position"];

    $sql = "INSERT INTO employee_registration (employee_name, employee_email, employee_position) 
            VALUES ('$employee_name', '$employee_email', '$employee_position')";

    if ($conn->query($sql) === TRUE) {
        echo "New employee record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employee Registration</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Update with your Bootstrap path -->
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-4">Employee Registration Form</h2>
        <form class="row g-3" method="POST" action="index_admin.php?page=employee_registration_form">
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control" id="employeeName" name="employee_name" placeholder="Employee Name" required>
                    <label for="employeeName">Employee Name</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="email" class="form-control" id="employeeEmail" name="employee_email" placeholder="Employee Email" required>
                    <label for="employeeEmail">Employee Email</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control" id="employeePosition" name="employee_position" placeholder="Employee Position" required>
                    <label for="employeePosition">Employee Position</label>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" name="btn_submit" class="btn btn-primary">Register</button>
                <button type="reset" class="btn btn-secondary">Reset</button>
            </div>
        </form>
    </div>
</body>
</html>
