<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "loan_application";

// Create connection
$conn = new mysqli($servername, $username, $password,$database);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}


if ($_SERVER['REQUEST_METHOD'] == 'POST') {

    // Collect and sanitize form input
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['email']));
    $loan_amount = htmlspecialchars(trim($_POST['loan_amount']));
    $loan_term = htmlspecialchars(trim($_POST['loan_term']));
    $interest_rate = htmlspecialchars(trim($_POST['interest_rate']));
    $purpose = htmlspecialchars(trim($_POST['purpose']));

    // Check if all required fields are filled
    if (empty($name) || empty($email) || empty($loan_amount) || empty($loan_term) || empty($interest_rate) || empty($purpose)) {
        echo "<p>Please fill in all fields.</p>";
    } else {
        // Process loan data (for example, calculating total payment)
        $total_payment = $loan_amount * pow(1 + ($interest_rate / 100), $loan_term); // Simple interest calculation

        echo "<h2>Loan Application Summary</h2>";
        echo "<p><strong>Name:</strong> $name</p>";
        echo "<p><strong>Email:</strong> $email</p>";
        echo "<p><strong>Loan Amount:</strong> \$$loan_amount</p>";
        echo "<p><strong>Loan Term:</strong> $loan_term years</p>";
        echo "<p><strong>Interest Rate:</strong> $interest_rate%</p>";
        echo "<p><strong>Purpose:</strong> $purpose</p>";
        echo "<p><strong>Total Payment (with interest):</strong> \$" . number_format($total_payment, 2) . "</p>";

        // Here you could also store the information in a database or send an email to the user

        // Example database connection (MySQL - MySQLi)
        /*
        $conn = new mysqli('localhost', 'username', 'password', 'database');
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $stmt = $conn->prepare("INSERT INTO loans (name, email, loan_amount, loan_term, interest_rate, purpose) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssddds", $name, $email, $loan_amount, $loan_term, $interest_rate, $purpose);
        $stmt->execute();
        $stmt->close();
        $conn->close();
        */
    }

} else {
    echo "<p>No data submitted. Please go back to the form and submit it.</p>";
}
?>
