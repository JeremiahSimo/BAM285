

<?php
include 'modules/connect2.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dating App Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            color: #333;
            margin-top: 50px;
            font-size: 2em;
        }

        form {
            max-width: 400px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            font-size: 1.1em;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1em;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        textarea {
            resize: vertical;
        }

        @media (max-width: 600px) {
            form {
                padding: 15px;
                margin: 20px;
            }

            h2 {
                font-size: 1.8em;
            }

            input[type="submit"] {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <h2>Sign Up for the Dating App</h2>
    <form method="POST" action="modules/connect2.php">

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

<?php 
include 'modules/connect.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> 
    <title>Online Job Application</title>
</head>
<body>
    <div id="svg_wrap"></div>

    <h1>Online Job Application</h1>
    <section>
       
        <form id="applicationForm" method="POST" >
            <input type="text" placeholder="Firstname" name="Firstname" required />
            <input type="text" placeholder="Surname" name="Surname" required />
            <input type="date" placeholder="Birthdate" name="Birthdate" required />
            <input type="text" placeholder="Street" name="Street" required />
            <input type="text" placeholder="City" name="City" required />
            <input type="text" placeholder="Mobile" name="Mobile" required />
           
            <button class="button" type="button" onclick="submitForm()">Submit</button>
        </form>
        <div id="responseMessage"></div> 
    </section>

    <script>
        
        function submitForm() {
            
            var formData = $("#applicationForm").serialize();
            
            
            $.ajax({
                url: "modules/connect.php",  
                type: "POST",       
                data: formData,      
                success: function(response) {
                    // Display the response from PHP (e.g., success or error message)
                    $("#responseMessage").html(response);
                },
                error: function(xhr, status, error) {
                    // Display error message if AJAX request fails
                    $("#responseMessage").html("There was an error submitting the form.");
                }
            });
        }
    </script>
</body>
</html>
<?php
include 'modules/contact.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f7f7f7;
            margin: 0;
            padding: 0;
        }

        h1 {
            text-align: center;
            color: #333;
            margin-top: 50px;
            font-size: 2em;
        }

        section {
            max-width: 500px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        form {
            display: flex;
            flex-direction: column;
            gap: 10px;
        }

        label {
            font-size: 1.1em;
            color: #333;
        }

        input[type="text"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 10px;
            margin: 8px 0;
            border: 1px solid #ddd;
            border-radius: 5px;
            box-sizing: border-box;
            font-size: 1em;
        }

        input[type="submit"] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 5px;
            font-size: 1.1em;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        textarea {
            resize: vertical;
        }

        @media (max-width: 600px) {
            section {
                padding: 15px;
                margin: 20px;
            }

            h1 {
                font-size: 1.8em;
            }

            input[type="submit"] {
                font-size: 1em;
            }
        }
    </style>
</head>
<body>
    <h1>Contact Us</h1>
    <section>
        <form method="POST" action="modules/contact.php">
            <label for="full_name">Full Name:</label>
            <input type="text" id="full_name" name="full_name" required><br><br>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>

            <label for="subject">Subject:</label>
            <input type="text" id="subject" name="subject" required><br><br>

            <label for="message">Message:</label><br>
            <textarea id="message" name="message" rows="4" cols="50" required></textarea><br><br>

            <input type="submit" value="Send Message">
        </form>
    </section>
</body>
</html>

