<?php
$name = "John Rey Q. Clemeña";
$title = "BSIT Student";
$email = "john@example.com";  
$phone = "(123) 456-7890";    
$github = "https://github.com/johnrey"; 
$linkedin = "https://www.linkedin.com/in/johnrey"; 
$projects = [
    [
        'title' => 'Project 1',
        'description' => 'A brief description of Project 1',
        'link' => '#'
    ],
    [
        'title' => 'Project 2',
        'description' => 'A brief description of Project 2',
        'link' => '#'
    ],
    [
        'title' => 'Project 3',
        'description' => 'A brief description of Project 3',
        'link' => '#'
    ],
];

$experience = [
    [
        'title' => 'Intern - Web Developer',
        'company' => 'Tech Innovations Co.',
        'duration' => 'June 2023 - August 2023',
        'description' => 'Developed and maintained websites for small businesses using PHP and MySQL.'
    ],
    [
        'title' => 'Freelancer - Web Developer',
        'company' => 'Self-employed',
        'duration' => 'January 2022 - Present',
        'description' => 'Worked on various freelance projects, including e-commerce sites, personal blogs, and company portfolios.'
    ],
];

$education = [
    [
        'degree' => 'Bachelor of Science in Information Technology',
        'institution' => 'University of Example',
        'graduation' => '2024',
        'description' => 'Pursuing a degree in Information Technology with a focus on web development and programming.'
    ],
];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $name; ?> - Portfolio</title>
    <style>
        /* Global Styles */
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            scroll-behavior: smooth;
        }
        header {
            background-color: #666;
            color: white;
            text-align: center;
            padding: 50px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1s ease-out;
        }
        header h1 {
            margin: 0;
            font-size: 2.5em;
        }
        header p {
            margin-top: 5px;
            font-size: 1.2em;
            font-weight: 300;
        }

        /* Container and Layout */
        .container {
            width: 80%;
            margin: 30px auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            animation: fadeIn 1.5s ease-out;
        }
        .section-title {
            font-size: 1.8em;
            margin-bottom: 10px;
            color: #333;
            font-weight: 600;
        }
        .section-content {
            margin-bottom: 20px;
        }

        /* Section Styles */
        .skills, .projects, .experience, .education, .contact {
            margin-bottom: 30px;
        }
        .skills ul, .projects ul, .experience ul, .education ul {
            list-style-type: none;
            padding: 0;
        }
        .skills li, .projects li, .experience li, .education li {
            background-color: #f9f9f9;
            margin: 10px 0;
            padding: 10px;
            border-radius: 4px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .skills li:hover, .projects li:hover, .experience li:hover, .education li:hover {
            transform: scale(1.05);
        }
        .projects li a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
            transition: color 0.3s ease;
        }
        .projects li a:hover {
            color: #4e73df;
            text-decoration: underline;
        }

        /* Buttons */
        .button {
            background-color: #4e73df;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
            transition: background-color 0.3s ease;
        }
        .button:hover {
            background-color: #2e59d9;
        }

        /* Footer */
        footer {
            text-align: center;
            background-color: #333;
            color: white;
            padding: 20px 0;
            margin-top: 30px;
            animation: fadeIn 2s ease-out;
        }
        footer a {
            color: #f4f4f4;
            text-decoration: none;
            margin: 0 10px;
        }
        footer a:hover {
            text-decoration: underline;
        }

        /* Animation */
        @keyframes fadeIn {
            0% {
                opacity: 0;
                transform: translateY(20px);
            }
            100% {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* Responsive Design */
        @media (max-width: 768px) {
            .container {
                width: 90%;
            }
            header h1 {
                font-size: 2em;
            }
        }
    </style>
</head>
<body>

<header>
    <h1><?php echo $name; ?></h1>
    <p><?php echo $title; ?></p>
</header>

<div class="container">
    <section class="about">
        <h2 class="section-title">About Me</h2>
        <div class="section-content">
            <p>Hello! I am <?php echo $name; ?>, currently a BSIT student passionate about web development, programming, and technology. I am actively learning and building projects to enhance my skills and contribute to the tech community.</p>
        </div>
    </section>

    <section class="skills">
        <h2 class="section-title">Skills</h2>
        <div class="section-content">
            <ul>
                <li>PHP, HTML, CSS, JavaScript</li>
                <li>MySQL, PostgreSQL</li>
                <li>Frameworks: Laravel, Bootstrap</li>
                <li>Version Control: Git, GitHub</li>
                <li>Problem-solving and debugging</li>
                <li>Responsive Web Design</li>
            </ul>
        </div>
    </section>

    <section class="projects">
        <h2 class="section-title">Projects</h2>
        <div class="section-content">
            <ul>
                <?php foreach ($projects as $project): ?>
                    <li>
                        <a href="<?php echo $project['link']; ?>"><?php echo $project['title']; ?></a>
                        <p><?php echo $project['description']; ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section class="experience">
        <h2 class="section-title">Experience</h2>
        <div class="section-content">
            <ul>
                <?php foreach ($experience as $job): ?>
                    <li>
                        <strong><?php echo $job['title']; ?></strong> at <em><?php echo $job['company']; ?></em> (<?php echo $job['duration']; ?>)
                        <p><?php echo $job['description']; ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section class="education">
        <h2 class="section-title">Education</h2>
        <div class="section-content">
            <ul>
                <?php foreach ($education as $edu): ?>
                    <li>
                        <strong><?php echo $edu['degree']; ?></strong> from <em><?php echo $edu['institution']; ?></em> (Graduating in <?php echo $edu['graduation']; ?>)
                        <p><?php echo $edu['description']; ?></p>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </section>

    <section class="contact">
        <h2 class="section-title">Contact</h2>
        <div class="section-content">
            <p>You can reach me at:</p>
            <ul>
                <li>Email: <a href="mailto:<?php echo $email; ?>"><?php echo $email; ?></a></li>
                <li>Phone: <?php echo $phone; ?></li>
            </ul>
            <p>Feel free to connect with me on <a href="<?php echo $github; ?>" target="_blank">GitHub</a> or <a href="<?php echo $linkedin; ?>" target="_blank">LinkedIn</a>.</p>
            <a href="mailto:<?php echo $email; ?>" class="button">Contact Me</a>
        </div>
    </section>
</div>



</body>
</html>


