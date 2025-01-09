<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "db_daycare"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input values to prevent XSS
    $full_name = htmlspecialchars($_POST["input_fullname"]);
    $dob = $_POST["input_dob"];
    $age = $_POST["input_age"];
    $parent_name = htmlspecialchars($_POST["input_parentname"]);
    $contact_info = htmlspecialchars($_POST["input_contact"]);
    $gender = $_POST["input_gender"];
    $special_notes = htmlspecialchars($_POST["input_notes"]);

    // Check if any field is empty
    if (empty($full_name) || empty($dob) || empty($age) || empty($parent_name) || empty($contact_info) || empty($gender)) {
        echo "<div class='error'>All fields are required!</div>";
    } else {
        // Prepare SQL query
        $stmt = $conn->prepare("INSERT INTO Children (full_name, date_of_birth, age, parent_name, contact_info, gender, special_notes) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssissss", $full_name, $dob, $age, $parent_name, $contact_info, $gender, $special_notes);

        if ($stmt->execute()) {
            echo "<div class='success'>Child enrolled successfully!</div>";
        } else {
            echo "<div class='error'>Error: " . $stmt->error . "</div>";
        }

        // Close the statement
        $stmt->close();
    }
}

// Close the connection
$conn->close();
?>

<h5 class="card-title">Child Enrollment Form</h5>

<form class="row g-3" method="POST" action="">
    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingName" name="input_fullname" placeholder="Full Name" required>
            <label for="floatingName">Full Name:</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="date" class="form-control" id="floatingDOB" name="input_dob" placeholder="Date of Birth" required>
            <label for="floatingDOB">Date of Birth:</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="number" class="form-control" id="floatingAge" name="input_age" placeholder="Age" required>
            <label for="floatingAge">Age:</label>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingParentName" name="input_parentname" placeholder="Parent/Guardian Name" required>
            <label for="floatingParentName">Parent/Guardian Name:</label>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingContact" name="input_contact" placeholder="Contact Information" required>
            <label for="floatingContact">Contact Information:</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <select class="form-control" id="floatingGender" name="input_gender" required>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>
            <label for="floatingGender">Gender:</label>
        </div>
    </div>

    <div class="col-md-12">
        <div class="form-floating">
            <textarea class="form-control" id="floatingNotes" name="input_notes" placeholder="Allergies/Special Notes"></textarea>
            <label for="floatingNotes">Allergies/Special Notes:</label>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
</form>
