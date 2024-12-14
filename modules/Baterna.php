<?php
include "../includes/MyConnection.php"; // Correct the path if necessary

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $amount = $_POST["loan_amount"];
    $year = $_POST["loan_term"];
    $rate = $_POST["interest_rate"];
    $address = $_POST["purpose"];

    // Your database insert code
    $sql = "INSERT INTO loans (name, email, loan_amount, loan_term, loan_rate, loan_purpose, application_date) 
            VALUES ('$name', '$email', '$amount', '$year','$rate', '$address')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Your loan application has been submitted successfully!');</script>";
    } else {
        echo "<script>alert('Error: " . $conn->error . "');</script>";
    }

    // Close the connection after processing
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Loan Application Form</title>
    <link rel="stylesheet" href="styles.css"> <!-- Optional: For styling -->
</head>
<style>
body {
    font-family: Arial, sans-serif;
    margin: 40px;
    background-color: #f4f4f9;
}

h1 {
    text-align: center;
    color: #4CAF50;
}

form {
    max-width: 600px;
    margin: 0 auto;
    padding: 20px;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

label {
    font-size: 14px;
    font-weight: bold;
    margin-bottom: 8px;
    display: inline-block;
}

input[type="text"],
input[type="email"],
input[type="number"],
textarea {
    width: 100%;
    padding: 10px;
    margin: 10px 0 20px 0;
    border: 1px solid #ddd;
    border-radius: 4px;
}

textarea {
    resize: vertical;
}

input[type="submit"] {
    background-color: #4CAF50;
    color: white;
    border: none;
    padding: 12px 20px;
    cursor: pointer;
    border-radius: 4px;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #45a049;
}
</style>
<body>
    <h1>Loan Application Form</h1>

    <form action="" method="POST">
        <label for="name">Full Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="loan_amount">Loan Amount ($):</label><br>
        <input type="number" id="loan_amount" name="loan_amount" required><br><br>

        <label for="loan_term">Loan Term (Years):</label><br>
        <input type="number" id="loan_term" name="loan_term" required><br><br>

        <label for="interest_rate">Interest Rate (%):</label><br>
        <input type="number" id="interest_rate" name="interest_rate" step="0.1" required><br><br>

        <label for="purpose">Purpose of Loan:</label><br>
        <textarea id="purpose" name="purpose" rows="4" required></textarea><br><br>

        <input type="submit" value="Submit Application">
    </form>

</body>
</html>
