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

// Handle AJAX request for fetching full_name
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the student's full_name based on the ID
    $sql = "SELECT full_name FROM children WHERE id = ?";
    if ($stmt = $conn->prepare($sql)) {
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $stmt->bind_result($full_name);
        $stmt->fetch();

        // Return the student's full_name as JSON
        echo json_encode($full_name ? ['full_name' => $full_name] : null);

        $stmt->close();
    } else {
        echo json_encode(['error' => 'Database query error']);
    }
    $conn->close();
    exit;
}

if (isset($_POST['submit_feedback'])) {
    $student_id = $_POST['student_id'];
    $good_at = $_POST['good_at'];
    $overall_feedback = $_POST['overall_feedback'];

    // Prepare SQL query with placeholders for the parameters (no date_submitted)
    $stmt = $conn->prepare("INSERT INTO feedback (good_at, overall_feedback, student_id) VALUES (?, ?, ?)");

    // Bind the parameters (using 's' for string and 'i' for integer)
    $stmt->bind_param("ssi", $good_at, $overall_feedback, $student_id);

    // Execute the statement and check if successful
    if ($stmt->execute()) {
        echo "<p class='alert alert-success'>Feedback submitted successfully!</p>";
    } else {
        echo "<p class='alert alert-danger'>Error: " . $stmt->error . "</p>";
    }

    // Close the prepared statement and connection
    $stmt->close();
    $conn->close();
}

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

        <form action="index_admin.php?page=feedback" method="POST">
            <div class="form-group">
                <label for="id">Student ID:</label>
                <input type="number" id="id" name="student_id" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="student_name" class="form-control" readonly required>
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
    document.getElementById('id').addEventListener('input', function () {
        const id = this.value;

        if (id) {
            fetch(`modules/feedback.php?id=${id}`)
                .then(response => response.json())
                .then(data => {
                    if (data && data.full_name) {
                        document.getElementById('full_name').value = data.full_name;
                    } else {
                        document.getElementById('full_name').value = 'No student found';
                    }
                })
                .catch(error => {
                    console.error('Error fetching full name:', error);
                    document.getElementById('full_name').value = 'Error fetching data';
                });
        } else {
            document.getElementById('full_name').value = ''; // Clear field if no ID
        }
    });
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
</body>
</html>
