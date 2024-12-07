<section>
  <nav>
    <ul>
      <li><a href="home_page.php?page=london">London</a></li>
      <li><a href="home_page.php?page=paris">Paris</a></li>
      <li><a href="home_page.php?page=tokyo">Tokyo</a></li>
      <li><a href="home_page.php?page=madelo">Madelo</a></li> 
    </ul>
  </nav>
  
  <article>
    <?php
        if (isset($_GET['page'])){
       
            $page = htmlspecialchars($_GET['page']);
            
            switch ($page) {
                case 'london':
                    include 'london.php';
                    break;
                    
                case 'paris':
                    include 'paris.php';
                    break;
                    
                case 'tokyo':
                    include 'tokyo.php';
                    break;
                    
                case 'Madelo': 
                    include 'madelo.php';
                    break;
                    
                default:
                    echo "<p>Page not found.</p>"; // Default message if no valid page is found
                    break;
            }
        }
    ?>
  </article>
</section>

<!-- Personal Information -->
<p><strong>Name:</strong> Carl Vinncent D. Madelo</p>
<p><strong>Age:</strong> 21</p>
<p><strong>Occupation:</strong> Software Developer</p>
<p><strong>Address:</strong> Zone 9, Macanhan, Carmen, CDO</p>
