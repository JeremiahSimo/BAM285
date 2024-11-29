<?php
$name = "Christopher A. Simon Jr";
$profession = "Frond End Developer";
$location = "Carmen, CDOC";
$about = "I am passionate about Web Developer, with a particular interest in building responsive, user-friendly websites. I have a deep knowledge of HTML, CSS, JavaScript, and PHP, and I love learning new technologies to improve my skills.";
$skills = ["HTML", "CSS", "JavaScript", "PHP", "MySQL", "React", "Laravel"];
$contactEmail = "drazenmon@gmail.com";

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Me - <?php echo $name; ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        header {
            background-color: #333;
            color: #fff;
            text-align: center;
            padding: 20px;
        }
        header h1 {
            margin: 0;
        }
        .container {
            max-width: 900px;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .profile-img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            object-fit: cover;
            margin: 20px 0;
        }
        .skills {
            list-style-type: none;
            padding: 0;
        }
        .skills li {
            background-color: #f1f1f1;
            margin: 5px 0;
            padding: 10px;
            border-radius: 5px;
        }
        .contact-info {
            margin-top: 20px;
        }
        .contact-info p {
            margin: 5px 0;
        }
    </style>
</head>
<body>

    <header>
        <h1>About Me - <?php echo $name; ?></h1>
    </header>

    <div class="container">
        <img src="<?php echo $profilePicture; ?>" alt="Profile Picture" class="profile-img">

        <h2>Hi, I'm <?php echo $name; ?>!</h2>
        <p><strong>Profession:</strong> <?php echo $profession; ?></p>
        <p><strong>Location:</strong> <?php echo $location; ?></p>

        <h3>About Me</h3>
        <p><?php echo $about; ?></p>

        <h3>Skills</h3>
        <ul class="skills">
            <?php foreach ($skills as $skill): ?>
                <li><?php echo $skill; ?></li>
            <?php endforeach; ?>
        </ul>

        <div class="contact-info">
            <h3>Contact Me</h3>
            <p><strong>Email:</strong> <a href="mailto:<?php echo $contactEmail; ?>"><?php echo $contactEmail; ?></a></p>
        </div>
    </div>

</body>
</html>
