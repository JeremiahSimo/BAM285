<?php
// Profile Data (can be modified or fetched from a database later)
$name = "Andrea Marie Plamos";
$age = 20;
$location = "Hillside Village, Cagayan de Oro";
$aboutMe = "I'm a passionate animal lover who enjoys spending time with my adorable pets. They bring joy and warmth to my life.";

$pets = [
    "PB", "Ginger", "Yunasan", "Catriona", "Orenge", "Pinpinah", "Batbat"
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $name; ?>'s Profile</title>
    <style>
        /* General Styles */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Arial', sans-serif;
            background-color: #f4f4f9;
            color: #333;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
        }

        /* Header */
        .header {
            text-align: center;
            margin-bottom: 30px;
        }

        .header h1 {
            color: #3498db;
            font-size: 36px;
            text-transform: uppercase;
            letter-spacing: 2px;
        }

        /* Profile Section */
        .profile {
            display: flex;
            align-items: center;
            justify-content: space-around;
            margin-bottom: 40px;
        }

        .photo img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }

        .bio {
            max-width: 600px;
        }

        .bio h2 {
            color: #3498db;
            font-size: 28px;
            margin-bottom: 10px;
        }

        .bio p {
            font-size: 18px;
            line-height: 1.6;
        }

        .bio p strong {
            font-weight: bold;
        }

        /* Pets Section */
        .pets {
            margin-bottom: 40px;
        }

        .pets h2 {
            color: #e67e22;
            font-size: 30px;
            margin-bottom: 15px;
            text-align: center;
        }

        .pets ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }

        .pets ul li {
            font-size: 20px;
            color: #2c3e50;
            margin: 5px 0;
        }

        /* Footer */
        .footer {
            text-align: center;
            padding: 20px;
            background-color: #3498db;
            color: white;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <header class="header">
            <h1>Welcome to <?php echo $name; ?>'s Profile</h1>
        </header>

        <div class="profile">
            <div class="photo">
                <img src="https://via.placeholder.com/150" alt="Andrea's Photo">
            </div>
            <div class="bio">
                <h2>About Me</h2>
                <p><strong>Name:</strong> <?php echo $name; ?></p>
                <p><strong>Age:</strong> <?php echo $age; ?> Years Old</p>
                <p><strong>Location:</strong> <?php echo $location; ?></p>
                <p><strong>About Me:</strong> <?php echo $aboutMe; ?></p>
            </div>
        </div>

        <div class="pets">
            <h2>My Beloved Pets</h2>
            <ul>
                <?php foreach ($pets as $pet) : ?>
                    <li><?php echo $pet; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>

        <footer class="footer">
            <p>&copy; 2024 <?php echo $name; ?></p>
        </footer>
    </div>
</body>
</html>
 