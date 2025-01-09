<?php
// Database connection
$host = 'localhost';
$db = 'db_daycare';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the student_id is passed in the GET request
if (isset($_GET['student_id'])) {
    $student_id = $_GET['student_id'];

    // Fetch the student's name based on the ID
    $sql = "SELECT full_name FROM Children WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param('i', $student_id);
    $stmt->execute();
    $stmt->bind_result($full_name);
    $stmt->fetch();

    // Return the student's name as JSON
    if ($full_name) {
        echo json_encode(['full_name' => $full_name]);
    } else {
        echo json_encode(null);  // Return null if no student found
    }

    $stmt->close();
} else {
    echo json_encode(null); // Return null if student_id is not provided
}

$conn->close();
?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Feedback</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Student Feedback Form</h2>

        <form action="feedback.php" method="POST">
    <div class="form-group">
        <label for="student_id">Student ID:</label>
        <input type="number" id="student_id" name="student_id" class="form-control" required>
    </div>


            <div class="form-group">
                <label for="student_name">Student Name:</label>
                <input type="text" id="student_name" name="student_name" class="form-control" readonly required>
            </div>

            <div class="form-group">
                <label for="good_at">Good At:</label>
                <textarea name="good_at" id="good_at" class="form-control" rows="4" required></textarea>
            </div>

            <div class="form-group">
                <label for="overall_feedback">Overall Feedback:</label>
                <textarea name="overall_feedback" id="overall_feedback" class="form-control" rows="4" required></textarea>
            </div>

            <div class="text-center">
                <button type="submit" name="submit_feedback" class="btn btn-primary">Submit Feedback</button>
            </div>
        </form>
    </div>

    <script>
        // Event listener to detect changes in the student_id input field
        document.getElementById('student_id').addEventListener('input', function() {
    const student_id = this.value;

    if (student_id) {
        // Make AJAX request to fetch student name based on the entered ID
        fetch(`get_student_name.php?student_id=${student_id}`)
            .then(response => response.json())
            .then(data => {
                if (data) {
                    document.getElementById('student_name').value = data.full_name;
                } else {
                    document.getElementById('student_name').value = 'No student found';
                }
            })
            .catch(error => {
                console.error('Error fetching student name:', error);
                document.getElementById('student_name').value = 'Error fetching data';
            });
    } else {
        document.getElementById('student_name').value = '';  // Clear if no ID entered
    }
});

    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>


<?php
// Check if the form is submitted
if (isset($_POST['submit_feedback'])) {
    // Get form data
    $student_id = $_POST['student_id'];
    $student_name = $_POST['student_name'];
    $good_at = $_POST['good_at'];
    $overall_feedback = $_POST['overall_feedback'];

    // Database connection
    $host = 'localhost';
    $db = 'db_daycare';
    $user = 'root';
    $pass = '';

    $conn = new mysqli($host, $user, $pass, $db);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Insert feedback into the database
    $stmt = $conn->prepare("INSERT INTO Feedback (student_name, student_id, good_at, overall_feedback) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssss", $student_name, $student_id, $good_at, $overall_feedback);

    if ($stmt->execute()) {
        echo "<p class='alert alert-success'>Feedback submitted successfully!</p>";
    } else {
        echo "<p class='alert alert-danger'>Error: " . $stmt->error . "</p>";
    }

    $stmt->close();
    $conn->close();
}
?>
