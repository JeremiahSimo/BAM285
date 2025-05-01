<?php
// Start session to track user login
session_start();

// Define valid credentials (for demonstration purposes)
$valid_username = "user";
$valid_password = "password123";

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if credentials are correct
    if ($username == $valid_username && $password == $valid_password) {
        $_SESSION['loggedin'] = true;
        header("Location: dashboard.php");  // Redirect to a new page after successful login
        exit();
    } else {
        $error_message = "Invalid username or password.";
        
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="login-container">
    <h2>Login</h2>
    <?php
    // Display error message if login failed
    if (isset($error_message)) {
        echo "<div class='error'>$error_message</div>";
    }
    ?>
    <form method="POST" action="login.php">
        <div class="input-group">
            <label for="username">Username</label>
            <input type="text" name="username" id="username" required>
        </div>
        <div class="input-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" required>
        </div>
        <button type="submit" class="btn">Login</button>
    </form>
</div>

</body>
</html>
