<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "form_db"; // Replace with your actual database name

$conn = new mysqli($servername, $username, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitize input values to prevent XSS
    $name = htmlspecialchars($_POST["input_fullname"]);
    $email = filter_var($_POST["input_email"], FILTER_SANITIZE_EMAIL);
    $address = htmlspecialchars($_POST["input_st_address"]);
    $city = htmlspecialchars($_POST["input_city"]);
    $zip = htmlspecialchars($_POST["input_zip"]);

    // Check if any field is empty
    if (empty($name) || empty($email) || empty($address) || empty($city) || empty($zip)) {
        echo "<div class='error'>All fields are required!</div>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Validate email format
        echo "<div class='error'>Invalid email format!</div>";
    } else {
        // Prepare SQL query
        $stmt = $conn->prepare("INSERT INTO employee (user_name, user_email, user_address, user_city, user_zip) VALUES (?, ?, ?, ?, ?)");
        $stmt->bind_param("sssss", $name, $email, $address, $city, $zip);

        if ($stmt->execute()) {
            echo "<div class='success'>New record created successfully!</div>";
        } else {
            echo "<div class='error'>Error: " . $stmt->error . "</div>";
        }

        // Close the statement
       
    }
}

// Close the connection
$conn->close();
?>


<h5 class="card-title">Employee Address Form</h5>

<form class="row g-3" method="POST" action="index_admin.php?page=employee_address_form">
    <div class="col-md-12">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingName" name="input_fullname" placeholder="Employee Name" required>
            <label for="floatingName">Employee Name:</label>
        </div>
    </div>

    <div class="col-md-10">
        <div class="form-floating">
            <input type="email" class="form-control" id="floatingEmail" name="input_email" placeholder="Email" required>
            <label for="floatingEmail">Email:</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingAddress" name="input_st_address" placeholder="Street Address" required>
            <label for="floatingAddress">Street Address:</label>
        </div>
    </div>

    <div class="col-md-6">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingCity" name="input_city" placeholder="City" required>
            <label for="floatingCity">City:</label>
        </div>
    </div>

    <div class="col-md-2">
        <div class="form-floating">
            <input type="text" class="form-control" id="floatingZip" name="input_zip" placeholder="Zip Code" required>
            <label for="floatingZip">Zip Code:</label>
        </div>
    </div>

    <div class="text-center">
        <button type="submit" name="btn_submit" class="btn btn-primary">Submit</button>
        <button type="reset" class="btn btn-secondary">Reset</button>
    </div>
</form>



