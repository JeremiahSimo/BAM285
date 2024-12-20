<?php
include "includes/connection.php";

if (isset($_POST["btn_submit"])) {
    $student_name = $_POST["student_name"];
    $student_email = $_POST["student_email"];
    $student_course = $_POST["student_course"];

    $sql = "INSERT INTO student_registration (student_name, student_email, student_course) 
            VALUES ('$student_name', '$student_email', '$student_course')";

    if ($conn->query($sql) === TRUE) {
        echo "New student record created successfully";
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
    <title>Student Registration</title>
    <link rel="stylesheet" href="path/to/bootstrap.css"> <!-- Update with your Bootstrap path -->
</head>
<body>
    <div class="container">
        <h2 class="text-center mt-4">Student Registration Form</h2>
        <form class="row g-3" method="POST" action="index_admin.php?page=student_registration_form">
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control" id="studentName" name="student_name" placeholder="Student Name" required>
                    <label for="studentName">Student Name</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="email" class="form-control" id="studentEmail" name="student_email" placeholder="Student Email" required>
                    <label for="studentEmail">Student Email</label>
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-floating">
                    <input type="text" class="form-control" id="studentCourse" name="student_course" placeholder="Student Course" required>
                    <label for="studentCourse">Student Course</label>
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
