


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dating App Registration</title>
    <style>
        
    </style>
</head>
<body>
    <h2>Sign Up for the Dating App</h2>
    <form method="POST" action="php/connect2.php">

        <label for="full_name">Full Name:</label>
        <input type="text" id="full_name" name="full_name" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="gender">Gender:</label>
        <select id="gender" name="gender" required>
            <option value="Male">Male</option>
            <option value="Female">Female</option>
            <option value="Other">Other</option>
        </select><br><br>

        <label for="age">Age:</label>
        <input type="number" id="age" name="age" required><br><br>

        <label for="bio">Tell us about yourself:</label><br>
        <textarea id="bio" name="bio" rows="4" cols="50"></textarea><br><br>

        <input type="submit" value="Register">
    </form>
</body>
</html>
