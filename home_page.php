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
>>>>>>> 25397eae6e75891659ee3c7b874f71aa51a33c0c
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
>>>>>>> 25397eae6e75891659ee3c7b874f71aa51a33c0c
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
>>>>>>> 25397eae6e75891659ee3c7b874f71aa51a33c0c
section::after {
  content: "";
  display: table;
  clear: both;
}

<<<<<<< HEAD

=======
/* Style the footer */
>>>>>>> 25397eae6e75891659ee3c7b874f71aa51a33c0c
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
>>>>>>> 25397eae6e75891659ee3c7b874f71aa51a33c0c
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
      <li><a href="home_page.php?page=lipao">Lipao</a></li>
      <li><a href="home_page.php?page=morcillos">Morcillos Form</a></li>
      <li><a href="home_page.php?page=panong">Panong Form</a></li>
=======
=======
>>>>>>> 606ae2b26ac88e92b36e4544ff2d2f126c548b20
      <li><a href="home_page.php?page=panong">Panong</a></li>
      <li><a href="home_page.php?page=magpantay">Magpantay</a></li>
       <li><a href="home_page.php?page=clemena">Clemeña</a></li>
       <li><a href="home_page.php?page=Arazo">Arazo</a></li>
       <li><a href="home_page.php?page=Baterna">Junel</a></li>
<<<<<<< HEAD
>>>>>>> 27411fa8aacd73fff39989013b7c8bc8855ececc
=======
>>>>>>> 606ae2b26ac88e92b36e4544ff2d2f126c548b20
=======
      <li><a href="home_page.php?page=morcillos">Morcillos</a></li>
>>>>>>> 25397eae6e75891659ee3c7b874f71aa51a33c0c
    </ul>
  </nav>
  
  <article>
   <!-- content area -->
<<<<<<< HEAD



=======
>>>>>>> 25397eae6e75891659ee3c7b874f71aa51a33c0c
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
                            
<<<<<<< HEAD
<<<<<<< HEAD
                            case 'lipao' :
                              include 'modules/lipao.php' ;
                              break;

                              case 'morcillos' :
                                include 'modules/morcillos_forms.php';
                                break;

                                case 'panong' :
                                  include 'modules/panong_forms.php';
                                  break;

                              
=======
=======
>>>>>>> 606ae2b26ac88e92b36e4544ff2d2f126c548b20
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
  

<<<<<<< HEAD
>>>>>>> 27411fa8aacd73fff39989013b7c8bc8855ececc
=======
>>>>>>> 606ae2b26ac88e92b36e4544ff2d2f126c548b20

=======
                            case 'morcillos':
                              include 'modules/morcillos.php';
                              break;

>>>>>>> 25397eae6e75891659ee3c7b874f71aa51a33c0c
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

