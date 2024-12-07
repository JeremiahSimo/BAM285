<section>
  <nav>
    <ul>
      <li><a href="home_page.php?page=london">London</a></li>
      <li><a href="home_page.php?page=paris">Paris</a></li>
      <li><a href="home_page.php?page=tokyo">Tokyo</a></li>
      <li><a href="home_page.php?page=hibaya">hibaya</a></li>
      
    </ul>
  </nav>
  
  <article>
   <!-- content area -->
    <?php
        if (isset($_GET['page'])){
            $page=$_GET['page'];

            switch ($page){
                case 'london':
                    include 'london.php';
                    break;
                    
                    case 'paris':
                        include 'paris.php';
                        break;
                        
                        case 'tokyo':
                            include 'tokyo.php';
                            break;

                            case 'hibaya':
                              include 'hibaya.php';
                              break;

            }

        }
    ?>
  </article>
</section>


<h1>Carl Jeffrey Hibaya</h1>
    <p>Student/gwapo/crew</p>
    <p>macanhan, carmen, cagaayan de oro city</p>
 