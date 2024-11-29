<?php
// Self Introduction for Earl Karl Medequiso

// Personal Information
$name = "Earl Karl Medequiso";
$age = 25;
$hobbies = array("Reading", "Coding", "Music", "Traveling");
$profession = "Web Developer";
$location = "Manila, Philippines"; // You can change this as well

// Displaying the introduction
echo "<h1>Hi, I'm $name!</h1>";
echo "<p>I am $age years old, and I currently live in $location.</p>";
echo "<p>I work as a $profession, and I enjoy the following hobbies:</p>";

echo "<ul>";
foreach ($hobbies as $hobby) {
    echo "<li>$hobby</li>";
}
echo "</ul>";

// Fun Fact
$funFact = "I love learning new technologies and exploring different cultures!";
echo "<p>Fun Fact: $funFact</p>";
?>
