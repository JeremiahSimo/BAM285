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


header {
  background-color: #666;
  padding: 30px;
  text-align: center;
  font-size: 35px;
  color: white;
}


nav {
  float: left;
  width: 30%;
  background: #ccc;
  padding: 20px;
  min-height: calc(100vh - 130px);
}


nav ul {
  list-style-type: none;
  padding: 0;
}

article {
  float: left;
  padding: 20px;
  width: 70%;
  background-color: #f1f1f1;
  min-height: calc(100vh - 130px); 
}


section::after {
  content: "";
  display: table;
  clear: both;
}


footer {
  background-color: #777;
  padding: 10px;
  text-align: center;
  color: white;
  position: relative;
  bottom: 0;
  width: 100%;
}


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
      <li><a href="home_page.php?page=panong">Panong</a></li>
      <li><a href="home_page.php?page=magpantay">Magpantay</a></li>
       <li><a href="home_page.php?page=clemena">Clemeña</a></li>
       <li><a href="home_page.php?page=Arazo">Arazo</a></li>
       <li><a href="home_page.php?page=Baterna">Junel</a></li>
    </ul>
  </nav>
  
  <article>
   <!-- content area -->



    <?php
        if (isset($_GET['page'])){
            $page=$_GET['page'];

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
                            
                        case 'caamiño':
                          include 'modules/panong2.php';
                          break;

                          case 'magpantay':
                            include 'modules/magpantay.php';
                            break;

                            case 'clemena':
                            include 'modules/clemenajohnrey.php';
                            break;

                            case 'Arazo':
                              include 'modules/Arazo.php';
                              break;

                              case 'Baterna':
                                include 'modules/Baterna.php';
                                break;
  


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

