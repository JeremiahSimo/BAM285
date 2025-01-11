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

// Handle attendance submission
if (isset($_POST['submit_attendance'])) {
    $date = $_POST['date'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];

    // Loop through all children and insert their attendance status
    foreach ($_POST['attendance_status'] as $child_id => $attendance_status) {
        // Insert or update attendance record for each child
        $stmt = $conn->prepare("INSERT INTO attendance (date, child_id, check_in, check_out, attendance_status) 
                                VALUES (?, ?, ?, ?, ?) 
                                ON DUPLICATE KEY UPDATE check_in = ?, check_out = ?, attendance_status = ?");
        $stmt->bind_param(
            "sissssss",
            $date,
            $child_id,
            $check_in,
            $check_out,
            $attendance_status,
            $check_in,
            $check_out,
            $attendance_status
        );

        if (!$stmt->execute()) {
            echo "<div class='alert alert-danger'>Error: " . $stmt->error . "</div>";
        }
    }
    echo "<script>alert('Attendance recorded successfully!');</script>";
    $stmt->close();
}

// Fetch children based on selected gender
$gender = isset($_GET['gender']) ? $_GET['gender'] : 'Male'; // Default to Male if no gender is selected

// Prepare and execute the query with the selected gender
$stmt = $conn->prepare("SELECT id, full_name FROM children WHERE gender = ?");
$stmt->bind_param("s", $gender);
$stmt->execute();
$children_result = $stmt->get_result();

$children = [];
while ($row = $children_result->fetch_assoc()) {
    $children[] = $row;
}

$conn->close();
?>

<!-- Attendance Form -->
<h2 class="text-center">Attendance Form</h2>
<form method="POST">
    <div class="row g-3">
        <!-- Date Input -->
        <div class="col-md-6">
            <div class="form-floating">
                <input type="date" class="form-control" id="attendanceDate" name="date" required>
                <label for="attendanceDate">Date</label>
            </div>
        </div>

        <!-- Gender Selection -->
        <div class="col-md-6">
            <div class="form-floating">
                <select class="form-control" name="gender" id="gender" onchange="window.location.href='?gender=' + this.value;">
                    <option value="Male" <?php if ($gender == 'Male') echo 'selected'; ?>>Male</option>
                    <option value="Female" <?php if ($gender == 'Female') echo 'selected'; ?>>Female</option>
                    <option value="Other" <?php if ($gender == 'Other') echo 'selected'; ?>>Other</option>
                </select>
                <label for="gender">Gender</label>
            </div>
        </div>

        <!-- Display List of Children -->
        <div class="col-md-12">
            <h4>Children</h4>
            <?php if (count($children) > 0): ?>
                <?php foreach ($children as $child): ?>
                    <div class="child-entry">
                        <p><strong><?= $child['full_name'] ?></strong></p>
                        <input type="hidden" name="attendance_status[<?= $child['id'] ?>]" value="">

                        <!-- Check-in and Check-out Fields -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="time" class="form-control" name="check_in" required>
                                    <label for="check_in">Check-in Time</label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-floating">
                                    <input type="time" class="form-control" name="check_out" required>
                                    <label for="check_out">Check-out Time</label>
                                </div>
                            </div>
                        </div>

                        <!-- Attendance Status Checkboxes -->
                        <div class="mt-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="attendance_status[<?= $child['id'] ?>]" value="Present">
                                <label class="form-check-label" for="present_<?= $child['id'] ?>">Present</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="attendance_status[<?= $child['id'] ?>]" value="Absent">
                                <label class="form-check-label" for="absent_<?= $child['id'] ?>">Absent</label>
                            </div>
                        </div>
                    </div>
                    <hr>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="alert alert-warning">No children found for selected gender.</div>
            <?php endif; ?>
        </div>

        <!-- Submit Button -->
        <div class="text-center col-md-12">
            <button type="submit" name="submit_attendance" class="btn btn-primary">Submit Attendance</button>
        </div>
    </div>
</form>

<!-- JavaScript for Gender Selection -->
<script>
    document.getElementById('gender').addEventListener('change', function() {
    const gender = this.value;
    const currentUrl = window.location.href;
    const url = new URL(currentUrl);
    
    // Update the gender parameter, but keep the rest of the URL intact
    url.searchParams.set('gender', gender);
    window.location.href = url.toString();
});

</script>
