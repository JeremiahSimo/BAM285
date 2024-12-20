<?php
// Initialize variables
$name = $gender = $dob = $phone = $email = $address = $emergency_contact_name = $emergency_contact_phone = $blood_type = "";
$allergies = $medications = $medical_conditions = $insurance_provider = $insurance_id = $policyholder_name = $referral_source = $preferred_time = "";
$errors = [];

// Form submission handler
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs
    if (empty($_POST["name"])) {
        $errors[] = "Full Name is required.";
    } else {
        $name = test_input($_POST["name"]);
    }

    if (empty($_POST["gender"])) {
        $errors[] = "Gender is required.";
    } else {
        $gender = test_input($_POST["gender"]);
    }

    if (empty($_POST["dob"])) {
        $errors[] = "Date of Birth is required.";
    } else {
        $dob = test_input($_POST["dob"]);
    }

    if (empty($_POST["phone"])) {
        $errors[] = "Phone Number is required.";
    } else {
        $phone = test_input($_POST["phone"]);
    }

    if (empty($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Valid Email Address is required.";
    } else {
        $email = test_input($_POST["email"]);
    }

    if (empty($_POST["address"])) {
        $errors[] = "Address is required.";
    } else {
        $address = test_input($_POST["address"]);
    }

    if (empty($_POST["emergency_contact_name"])) {
        $errors[] = "Emergency Contact Name is required.";
    } else {
        $emergency_contact_name = test_input($_POST["emergency_contact_name"]);
    }

    if (empty($_POST["emergency_contact_phone"])) {
        $errors[] = "Emergency Contact Phone Number is required.";
    } else {
        $emergency_contact_phone = test_input($_POST["emergency_contact_phone"]);
    }

    if (empty($_POST["blood_type"])) {
        $errors[] = "Blood Type is required.";
    } else {
        $blood_type = test_input($_POST["blood_type"]);
    }

    $allergies = isset($_POST["allergies"]) ? implode(", ", $_POST["allergies"]) : "";
    $medications = isset($_POST["medications"]) ? test_input($_POST["medications"]) : "";
    $medical_conditions = isset($_POST["medical_conditions"]) ? test_input($_POST["medical_conditions"]) : "";
    $insurance_provider = isset($_POST["insurance_provider"]) ? test_input($_POST["insurance_provider"]) : "";
    $insurance_id = isset($_POST["insurance_id"]) ? test_input($_POST["insurance_id"]) : "";
    $policyholder_name = isset($_POST["policyholder_name"]) ? test_input($_POST["policyholder_name"]) : "";
    $referral_source = isset($_POST["referral_source"]) ? test_input($_POST["referral_source"]) : "";
    $preferred_time = isset($_POST["preferred_time"]) ? test_input($_POST["preferred_time"]) : "";

    // If no errors, process form submission
    if (empty($errors)) {
        // Here, you would typically insert the form data into a database
        // Example: save_patient_data($name, $gender, $dob, etc.);

        // For simplicity, we will just display a success message:
        echo "<h3>Registration Successful!</h3>";
        echo "<p>Name: $name</p>";
        // Add other fields you want to display here
    }
}

// Function to sanitize inputs
function test_input($data) {
    return htmlspecialchars(stripslashes(trim($data)));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Patient Registration Form</title>
</head>
<body>

<h2>Patient Registration Form</h2>

<?php
// Display errors if there are any
if (!empty($errors)) {
    echo "<div style='color: red;'><ul>";
    foreach ($errors as $error) {
        echo "<li>$error</li>";
    }
    echo "</ul></div>";
}
?>

<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
    <!-- Personal Information -->
    <label for="name">Full Name:</label><br>
    <input type="text" id="name" name="name" value="<?php echo $name; ?>" required><br><br>

    <label for="gender">Gender:</label><br>
    <input type="radio" id="male" name="gender" value="Male" <?php echo ($gender == 'Male' ? 'checked' : ''); ?> required> Male
    <input type="radio" id="female" name="gender" value="Female" <?php echo ($gender == 'Female' ? 'checked' : ''); ?>> Female
    <input type="radio" id="other" name="gender" value="Other" <?php echo ($gender == 'Other' ? 'checked' : ''); ?>> Other<br><br>

    <label for="dob">Date of Birth:</label><br>
    <input type="date" id="dob" name="dob" value="<?php echo $dob; ?>" required><br><br>

    <!-- Contact Information -->
    <label for="phone">Phone Number:</label><br>
    <input type="text" id="phone" name="phone" value="<?php echo $phone; ?>" required><br><br>

    <label for="email">Email Address:</label><br>
    <input type="email" id="email" name="email" value="<?php echo $email; ?>" required><br><br>

    <label for="address">Address:</label><br>
    <input type="text" id="address" name="address" value="<?php echo $address; ?>" required><br><br>

    <!-- Emergency Contact Information -->
    <label for="emergency_contact_name">Emergency Contact Name:</label><br>
    <input type="text" id="emergency_contact_name" name="emergency_contact_name" value="<?php echo $emergency_contact_name; ?>" required><br><br>

    <label for="emergency_contact_phone">Emergency Contact Phone Number:</label><br>
    <input type="text" id="emergency_contact_phone" name="emergency_contact_phone" value="<?php echo $emergency_contact_phone; ?>" required><br><br>

    <!-- Medical Information -->
    <label for="blood_type">Blood Type:</label><br>
    <select id="blood_type" name="blood_type" required>
        <option value="A+" <?php echo ($blood_type == 'A+' ? 'selected' : ''); ?>>A+</option>
        <option value="B+" <?php echo ($blood_type == 'B+' ? 'selected' : ''); ?>>B+</option>
        <option value="AB+" <?php echo ($blood_type == 'AB+' ? 'selected' : ''); ?>>AB+</option>
        <option value="O+" <?php echo ($blood_type == 'O+' ? 'selected' : ''); ?>>O+</option>
        <option value="A-" <?php echo ($blood_type == 'A-' ? 'selected' : ''); ?>>A-</option>
        <option value="B-" <?php echo ($blood_type == 'B-' ? 'selected' : ''); ?>>B-</option>
        <option value="AB-" <?php echo ($blood_type == 'AB-' ? 'selected' : ''); ?>>AB-</option>
        <option value="O-" <?php echo ($blood_type == 'O-' ? 'selected' : ''); ?>>O-</option>
    </select><br><br>

    <label for="allergies">Known Allergies:</label><br>
    <input type="checkbox" name="allergies[]" value="Pollen" <?php echo (strpos($allergies, 'Pollen') !== false ? 'checked' : ''); ?>> Pollen
    <input type="checkbox" name="allergies[]" value="Dust" <?php echo (strpos($allergies, 'Dust') !== false ? 'checked' : ''); ?>> Dust
    <input type="checkbox" name="allergies[]" value="Peanuts" <?php echo (strpos($allergies, 'Peanuts') !== false ? 'checked' : ''); ?>> Peanuts<br><br>

    <label for="medications">Current Medications:</label><br>
    <textarea name="medications" id="medications" rows="4"><?php echo $medications; ?></textarea><br><br>

    <label for="medical_conditions">Past Medical Conditions:</label><br>
    <textarea name="medical_conditions" id="medical_conditions" rows="4"><?php echo $medical_conditions; ?></textarea><br><br>

    <!-- Insurance Information -->
    <label for="insurance_provider">Insurance Provider:</label><br>
    <input type="text" name="insurance_provider" id="insurance_provider" value="<?php echo $insurance_provider; ?>"><br><br>

    <label for="insurance_id">Insurance ID Number:</label><br>
    <input type="text" name="insurance_id" id="insurance_id" value="<?php echo $insurance_id; ?>"><br><br>

    <label for="policyholder_name">Policyholder Name (if different):</label><br>
    <input type="text" name="policyholder_name" id="policyholder_name" value="<?php echo $policyholder_name; ?>"><br><br>

    <!-- Referral and Appointment Information -->
    <label for="referral_source">Referral Source:</label><br>
    <select name="referral_source" id="referral_source">
        <option value="Doctor" <?php echo ($referral_source == 'Doctor' ? 'selected' : ''); ?>>Doctor</option>
        <option value="Friend/Family" <?php echo ($referral_source == 'Friend/Family' ? 'selected' : ''); ?>>Friend/Family</option>
        <option value="Online Search" <?php echo ($referral_source == 'Online Search' ? 'selected' : ''); ?>>Online Search</option>
        <option value="Other" <?php echo ($referral_source == 'Other' ? 'selected' : ''); ?>>Other</option>
    </select><br><br>

    <label for="preferred_time">Preferred Appointment Time:</label><br>
    <select name="preferred_time" id="preferred_time">
        <option value="Morning" <?php echo ($preferred_time == 'Morning' ? 'selected' : ''); ?>>Morning</option>
        <option value="Afternoon" <?php echo ($preferred_time == 'Afternoon' ? 'selected' : ''); ?>>Afternoon</option>
        <option value="Evening" <?php echo ($preferred_time == 'Evening' ? 'selected' : ''); ?>>Evening</option>
    </select><br><br>

    <!-- Submit Button -->
    <input type="submit" value="Submit Registration">

</form>

</body>
</html>
