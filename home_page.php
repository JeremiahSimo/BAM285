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
<<<<<<< HEAD
  margin: 0;
  padding: 0;
}


=======
}

/* Style the header */
>>>>>>> 47e7c50186db8ae6fbd97a74ae51ce6595da5062
header {
  background-color: #666;
  padding: 30px;
  text-align: center;
  font-size: 35px;
  color: white;
}

<<<<<<< HEAD

nav {
  float: left;
  width: 30%;
  background: #ccc;
  padding: 20px;
  min-height: calc(100vh - 130px);
}


=======
/* Create two columns/boxes that floats next to each other */
nav {
  float: left;
  width: 30%;
  height: 300px; /* only for demonstration, should be removed */
  background: #ccc;
  padding: 20px;
}

/* Style the list inside the menu */
>>>>>>> 47e7c50186db8ae6fbd97a74ae51ce6595da5062
nav ul {
  list-style-type: none;
  padding: 0;
}

article {
  float: left;
  padding: 20px;
  width: 70%;
  background-color: #f1f1f1;
<<<<<<< HEAD
  min-height: calc(100vh - 130px); 
}


=======
  height: 300px; /* only for demonstration, should be removed */
}

/* Clear floats after the columns */
>>>>>>> 47e7c50186db8ae6fbd97a74ae51ce6595da5062
section::after {
  content: "";
  display: table;
  clear: both;
}

<<<<<<< HEAD

=======
/* Style the footer */
>>>>>>> 47e7c50186db8ae6fbd97a74ae51ce6595da5062
footer {
  background-color: #777;
  padding: 10px;
  text-align: center;
  color: white;
<<<<<<< HEAD
  position: relative;
  bottom: 0;
  width: 100%;
}


=======
}


/* Responsive layout - makes the two columns/boxes stack on top of each other instead of next to each other, on small screens */
>>>>>>> 47e7c50186db8ae6fbd97a74ae51ce6595da5062
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
<<<<<<< HEAD
<<<<<<< HEAD
<<<<<<< HEAD
      <li><a href="home_page.php?page=timbal">timbal</a></li>
=======
      <li><a href="home_page.php?page=moneth">magpulong</a></li>
>>>>>>> 8a90a023bd492ec093280e1a367293e05f8ec595
=======
      <li><a href="home_page.php?page=andrea">Andrea</a></li>
=======
      <li><a href="home_page.php?page=panong">Panong</a></li>
      <li><a href="home_page.php?page=magpantay">Magpantay</a></li>
       <li><a href="home_page.php?page=clemena">Clemeña</a></li>
       <li><a href="home_page.php?page=Arazo">Arazo</a></li>
       <li><a href="home_page.php?page=Baterna">Junel</a></li>
>>>>>>> 27411fa8aacd73fff39989013b7c8bc8855ececc
>>>>>>> 1001b26005881fa12686c40c5121c2f3207241f3
    </ul>
  </nav>
  
  
  
  <article>
   <!-- content area -->



=======
      <li><a href="home_page.php?page=panong">Panong</a></li>
      <li><a href="home_page.php?page=Arazo">Arazo</a></li>
    </ul>
  </nav>
  
  <article>
   <!-- content area -->
>>>>>>> 47e7c50186db8ae6fbd97a74ae51ce6595da5062
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
                            
<<<<<<< HEAD
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

                            case 'andrea':
                              include 'modules/andrea.php';
                              break;

                              case 'process_order':
                                include 'modules/process_order.php';
                                break;

<<<<<<< HEAD
                            case 'timbal':
                              include 'modules/timbal.php';
=======
                            case 'moneth':
                              include 'modules/moneth.php';
>>>>>>> 8a90a023bd492ec093280e1a367293e05f8ec595
                              break;
=======
                        case 'panong':
                          include 'modules/panong2.php';
                          break;

                          case 'Arazo':
                            include 'modules/Arazo.php';
                            break;

>>>>>>> 47e7c50186db8ae6fbd97a74ae51ce6595da5062

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

