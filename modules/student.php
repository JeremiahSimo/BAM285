<?php
// Include database connection
include "includes/connection.php";  // Ensure your database connection details are correct

// Initialize form data variables
$fullname = $email = $age = $address = $city = $state = $zip = $course = "";

// Check if the form is submitted
if (isset($_POST["btn_submit"])) {
    // Sanitize and retrieve form data
    $fullname = mysqli_real_escape_string($conn, $_POST["input_fullname"]);
    $email = mysqli_real_escape_string($conn, $_POST["input_email"]);
    $age = mysqli_real_escape_string($conn, $_POST["input_age"]);
    $address = mysqli_real_escape_string($conn, $_POST["input_address"]);
    $city = mysqli_real_escape_string($conn, $_POST["input_city"]);
    $state = mysqli_real_escape_string($conn, $_POST["input_state"]);
    $zip = mysqli_real_escape_string($conn, $_POST["input_zip"]);
    $course = mysqli_real_escape_string($conn, $_POST["input_course"]);

    // SQL query to insert data into the student_registration table
    $sql = "INSERT INTO student_registration (fullname, age, email, address, city, state, zip, course)
            VALUES ('$fullname', '$age', '$email', '$address', '$city', '$state', '$zip', '$course')";

    // Execute the query and check if the data was inserted successfully
    if ($conn->query($sql) === TRUE) {
        echo "Student registered successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<h5 class="card-title">Student Registration Form</h5>

<!-- Floating Labels Form -->
<form class="row g-3" method="POST" action="index_admin.php?page=registration_form">
    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingName" name="input_fullname" placeholder="Your Name" required>
            <label for="floatingName">Full Name</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="number" class="form-control" id="floatingAge" name="input_age" placeholder="Age" required>
            <label for="floatingAge">Age</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="email" class="form-control" id="floatingEmail" name="input_email" placeholder="Your Email" required>
            <label for="floatingEmail">Email</label>
        </div>
    </div>

    <div class="col-12">
        <div class="form-floating">
            <textarea class="form-control" placeholder="Address" id="floatingTextarea" name="input_address" style="height: 100px;" required></textarea>
            <label for="floatingTextarea">Address</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingCity" name="input_city" placeholder="City" required>
            <label for="floatingCity">City</label>
        </div>
    </div>

    <div class="col-md-4">
        <div class="form-floating mb-3">
            <select class="form-select" id="floatingSelect" name="input_state" aria-label="State" required>
                <option selected>Choose...</option>
                <option value="New York">New York</option>
                <option value="Oregon">Oregon</option>
                <option value="DC">DC</option>
            </select>
            <label for="floatingSelect">State</label>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingZip" name="input_zip" placeholder="Zip" required>
            <label for="floatingZip">Zip</label>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingCourse" name="input_course" placeholder="Course" required>
            <label for="floatingCourse">Course</label>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
</form>
<!-- End Floating Labels Form -->
