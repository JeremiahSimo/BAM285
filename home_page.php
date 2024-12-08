<!DOCTYPE html>
<html lang="en">
<head>
<title>CSS Template</title>
<link rel="stylesheet" href="h1.css">
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<style>
* {
  box-sizing: border-box;
}

body {
  font-family: Arial, Helvetica, sans-serif;
  margin: 0;
  padding: 0;
}

/* Style the header */
header {
  background-color: #666;
  padding: 30px;
  text-align: center;
  font-size: 35px;
  color: white;
}

/* Create two columns/boxes that floats next to each other */
nav {
  float: left;
  width: 30%;
  background: #ccc;
  padding: 20px;
  min-height: calc(100vh - 130px); /* Adjusted for header and footer height */
}

/* Style the list inside the menu */
nav ul {
  list-style-type: none;
  padding: 0;
}

article {
  float: left;
  padding: 20px;
  width: 70%;
  background-color: #f1f1f1;
  min-height: calc(100vh - 130px); /* Adjusted for header and footer height */
}

/* Clear floats after the columns */
section::after {
  content: "";
  display: table;
  clear: both;
}

/* Style the footer */
footer {
  background-color: #777;
  padding: 10px;
  text-align: center;
  color: white;
  position: relative;
  bottom: 0;
  width: 100%;
}

/* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
@media (max-width: 600px) {
  nav, article {
    width: 100%;
    height: auto;
  }
}
</style>
</head>
<body>

<h2>JESSE RAY MORCILLOS</h2>
<p>In this example, we have created a header, two columns/boxes and a footer. On smaller screens, the columns will stack on top of each other.</p>
<p>Resize the browser window to see the responsive effect (you will learn more about this in our next chapter - HTML Responsive.)</p>

<header>
  <h2>Cities</h2>
</header>

<section>
  <nav>
    <ul>
      <li><a href="home_page.php?page=london">London</a></li>
      <li><a href="home_page.php?page=paris">Paris</a></li>
      <li><a href="home_page.php?page=tokyo">Tokyo</a></li>
      <li><a href="home_page.php?page=panong2">Panong2</a></li>
      <li><a href="home_page.php?page=Arazo">Arazo</a></li>
      <li><a href="home_page.php?page=andrea">Andrea</a></li>
      <li><a href="home_page.php?page=baanan">Baanan</a></li>
      <li><a href="home_page.php?page=caamino">Caamiño</a></li>
      <li><a href="home_page.php?page=clemenajohnrey">Clemena</a></li>
      <li><a href="home_page.php?page=decena">Decena</a></li>
      <li><a href="home_page.php?page=doble">Doble</a></li>
      <li><a href="home_page.php?page=galarpe">Galarpe</a></li>
      <li><a href="home_page.php?page=jabulan">Jabulan</a></li>
      <li><a href="home_page.php?page=lipao">Lipao</a></li>
      <li><a href="home_page.php?page=magpantay">Magpantay</a></li>
      <li><a href="home_page.php?page=MORCILLOS">Morcillos</a></li>
      <li><a href="home_page.php?page=MORCILLOS2">Morcillos2</a></li>
      <li><a href="home_page.php?page=sumanda">Sumanda</a></li>
      <li><a href="home_page.php?page=taroy">Taroy</a></li>
      <li><a href="home_page.php?page=baterna">Baterna</a></li>
    </ul>
  </nav>
  
  <article>
    <!-- content area -->
    <?php
        if (isset($_GET['page'])){
            $page = $_GET['page'];

            switch ($page){
                case 'london':
                    include 'modules/london.php';
                    break;
                case 'paris':
                    include 'modules/paris.php';
                    break;
                case 'tokyo':
                    include 'modules/tokyo.php';
                    break;
                case 'Arazo':
                    include 'modules/Arazo.php';
                    break;
                case 'andrea':
                    include 'modules/andrea.php';
                    break;
                case 'baanan':
                    include 'modules/baanan.php';
                    break;
                case 'caamino':
                    include 'modules/caamiño.php';
                    break;
                case 'clemenajohnrey':
                    include 'modules/clemenajohnrey.php';
                    break;
                case 'decena':
                    include 'modules/decena.php';
                    break;
                case 'doble':
                    include 'modules/doble.php';
                    break;
                case 'galarpe':
                    include 'modules/galarpe.php';
                    break;
                case 'jabulan':
                    include 'modules/jabulan.php';
                    break;
                case 'lipao':
                    include 'modules/lipao.php';
                    break;
                case 'magpantay':
                    include 'modules/magpantay.php';
                    break;
                case 'MORCILLOS':
                    include 'modules/MORCILLOS.php';
                    break;
                case 'MORCILLOS2':
                    include 'modules/MORCILLOS2.php';
                    break;
                case 'panong2':
                    include 'modules/panong2.php';
                    break;
                case 'sumanda':
                    include 'modules/sumanda.php';
                    break;
                case 'taroy':
                    include 'modules/taroy.php';
                    break;
                    case 'baterna':
                      include 'modules/Baterna.php';
                      break;
                default:
                    echo "Page not found.";
            }
        }
    ?>
  </article>
</section>

<footer>
  <p>Footer</p>
</footer>

</body>
</html>
