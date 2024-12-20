<?php

// Database connection details
$host = "localhost"; 
$username = "root"; 
$password = "";     
$database = "stud_info";  // Ensure this is correct

$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize the input to prevent XSS
    $first_name = htmlspecialchars($_POST['first_name']);
    $last_name = htmlspecialchars($_POST['last_name']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $gender = htmlspecialchars($_POST['gender']);

    // Prepare the SQL query to insert the data
    $stmt = $conn->prepare("INSERT INTO students (firstname, lastname, email, address, gender) VALUES (?, ?, ?, ?, ?)");
    
    // Check if the statement is prepared correctly
    if (!$stmt) {
        die("Statement preparation failed: " . $conn->error);
    }

    // Bind parameters to the query
    $stmt->bind_param("sssss", $first_name, $last_name, $email, $address, $gender);

    // Execute the query
    if ($stmt->execute()) {
        echo "<p style='color:green; text-align:center;'>Form submitted successfully!</p>";
    } else {
        echo "<p style='color:red; text-align:center;'>Error: " . $stmt->error . "</p>";
    }

    // Close the prepared statement
    $stmt->close();
}

// Close the database connection
$conn->close();

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Form</title>
  <style>
    /* Your CSS for styling the form */
    .form {
      display: flex;
      flex-direction: column;
      gap: 15px;
      max-width: 400px;
      padding: 30px;
      border-radius: 20px;
      position: relative;
      background-color: #1a1a1a;
      color: #fff;
      border: 1px solid #333;
      margin: 100px auto;
    }

    .title {
      font-size: 30px;
      font-weight: 600;
      letter-spacing: -1px;
      position: relative;
      display: flex;
      align-items: center;
      padding-left: 30px;
      color: #00bfff;
    }

    .title::before {
      width: 18px;
      height: 18px;
    }

    .title::after {
      width: 18px;
      height: 18px;
      animation: pulse 1s linear infinite;
    }

    .title::before,
    .title::after {
      position: absolute;
      content: "";
      height: 16px;
      width: 16px;
      border-radius: 50%;
      left: 0px;
      background-color: #00bfff;
    }

    .flex {
      display: flex;
      width: 100%;
      gap: 10px;
    }

    .form label {
      position: relative;
    }

    .form label .input {
      background-color: #333;
      color: #fff;
      width: 100%;
      padding: 20px 10px 10px 10px;
      outline: 0;
      border: 1px solid rgba(105, 105, 105, 0.397);
      border-radius: 10px;
    }

    .form label .input + span {
      color: rgba(255, 255, 255, 0.5);
      position: absolute;
      left: 10px;
      top: 0px;
      font-size: 0.9em;
      cursor: text;
      transition: 0.3s ease;
    }

    .input {
      font-size: medium;
    }

    .submit {
      border: none;
      outline: none;
      padding: 12px;
      border-radius: 10px;
      color: #fff;
      font-size: 16px;
      transform: .3s ease;
      background-color: #00bfff;
    }

    .submit:hover {
      background-color: #00bfff96;
    }

    /* Style for the Gender section */
    .gender-options {
      display: flex;
      gap: 15px;
      justify-content: center;
      align-items: center;
      margin-top: 10px;
    }

    .gender-label {
      display: flex;
      align-items: center;
      cursor: pointer;
      padding: 10px;
      border-radius: 10px;
      background-color: #333;
      transition: background-color 0.3s;
    }

    .gender-label input {
      display: none;
    }

    .gender-text {
      font-size: 16px;
      color: #fff;
      margin-left: 8px;
      font-weight: 600;
    }
  </style>
</head>
<body>
  <!-- Form submission to 'madelo.php' -->
  <form class="form" method="POST" action="madelo.php">
    <p class="title">Student Simple Information</p>
    <p class="message">Signup now and get full access to our System.</p>
    <div class="flex">
      <label>
        <input class="input" type="text" name="first_name" placeholder=" " required="">
        <span>Firstname</span>
      </label>
      <label>
        <input class="input" type="text" name="last_name" placeholder=" " required="">
        <span>Lastname</span>
      </label>
    </div>

    <label>
      <input class="input" type="email" name="email" placeholder=" " required="">
      <span>Email</span>
    </label>

    <label>
      <input class="input" type="text" name="address" placeholder=" " required="">
      <span>Address</span>
    </label>

    <label>
      <span>Gender</span>
      <div class="gender-options">
        <label class="gender-label">
          <input type="radio" name="gender" value="Male" required>
          <span class="gender-text">Male</span>
        </label>
        <label class="gender-label">
          <input type="radio" name="gender" value="Female" required>
          <span class="gender-text">Female</span>
        </label>
      </div>
    </label>

    <button class="submit">Submit</button>
  </form>
</body>
</html>
