<?php
// Include database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'school_management';

// Create a connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Initialize form data variables
$student_name = $date = $status = $remarks = "";

// Check if the form is submitted
if (isset($_POST["btn_submit"])) {
    // Sanitize and retrieve form data
    $student_name = mysqli_real_escape_string($conn, $_POST["student_name"]);
    $date = mysqli_real_escape_string($conn, $_POST["date"]);
    $status = mysqli_real_escape_string($conn, $_POST["status"]);
    $remarks = mysqli_real_escape_string($conn, $_POST["remarks"]);

    // SQL query to insert data into the attendance table
    $sql = "INSERT INTO attendance (student_name, date, status, remarks)
            VALUES ('$student_name', '$date', '$status', '$remarks')";

    // Execute the query and check if the data was inserted successfully
    if ($conn->query($sql) === TRUE) {
        echo "Attendance recorded successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close the database connection
    $conn->close();
}
?>

<h5 class="card-title">Attendance Form</h5>

<!-- Attendance Form -->
<form class="row g-3" method="POST" action="">
    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingName" name="student_name" placeholder="Student Name" required>
            <label for="floatingName">Student Name</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="date" class="form-control" id="floatingDate" name="date" placeholder="Date" required>
            <label for="floatingDate">Date</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <select class="form-select" id="floatingStatus" name="status" aria-label="Attendance Status" required>
                <option selected>Choose...</option>
                <option value="Present">Present</option>
                <option value="Absent">Absent</option>
                <option value="Late">Late</option>
            </select>
            <label for="floatingStatus">Status</label>
        </div>
    </div>

    <div class="col-12">
        <div class="form-floating">
            <textarea class="form-control" placeholder="Remarks" id="floatingRemarks" name="remarks" style="height: 100px;"></textarea>
            <label for="floatingRemarks">Remarks (Optional)</label>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
</form>
<!-- End Attendance Form -->
