<?php
include 'connection.php';

/*
session_start(); // Start session

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo "<script>alert('Please log in first'); window.location.href='index.php';</script>";
    exit();
}

// Fetch logged-in admin's details from the `admin` table
$email = $_SESSION['email'];
$query = "SELECT * FROM admin WHERE email = '$email'";
$result = mysqli_query($con, $query);

// Check if the admin exists in the database
if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "<script>alert('Invalid session. Please log in again.'); window.location.href='index.php';</script>";
    exit();
}

*/

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>ACT</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.gstatic.com" rel="preconnect">
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i|Nunito:300,300i,400,400i,600,600i,700,700i|Poppins:300,300i,400,400i,500,500i,600,600i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="assets/vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="assets/vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="assets/vendor/simple-datatables/style.css" rel="stylesheet">
  <link href="assets/css/style.css" rel="stylesheet">
</head>
<body>

<header id="header" class="header fixed-top d-flex align-items-center" style="background-color: #f8f9fa; border-bottom: 1px solid #ddd;">
    <div class="d-flex align-items-center justify-content-between">
        <a href="index_admin.php?page=dashboard" class="logo d-flex align-items-center">
            <img src="assets/img/logo.png" alt="" style="max-height: 40px;">
            <span class="d-none d-lg-block" style="color: #000; font-weight: bold;">Admin Dashboard</span>
        </a>
        <i class="bi bi-list toggle-sidebar-btn"></i>
    </div>

    <!-- user profile -->
<!-- 
<div class="d-flex align-items-center">
    <span class="ms-auto me-3" style="color: #000;">Logged in as: <strong> 
    <?php echo $user['name']; ?></strong> (<?php echo $user['email']; ?>)</span>
    <a href="logout.php" class="btn btn-outline-dark btn-sm">Logout</a>
</div>
-->



</header>



  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

    <li class="nav-item">
    <a class="nav-link collapsed" href="index_admin.php?page=dashboard">
        <i class="bi bi-speedometer2"></i> <!-- Dashboard Icon -->
        <span>Dashboard</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="index_admin.php?page=add_employee">
        <i class="bi bi-person-plus"></i> <!-- Add Employee Icon -->
        <span>Add Employee</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="index_admin.php?page=approve_leaves">
        <i class="bi bi-check-circle"></i> <!-- Approve Leaves Icon -->
        <span>Request Leaves Status</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="index_admin.php?page=pending_leaves">
        <i class="bi bi-hourglass-split"></i> <!-- Pending Leaves Icon -->
        <span>Pending Leaves</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="index_admin.php?page=disapproved">
    <i class="bi bi-x-circle-fill"></i>
    
        <span>Disapproved Leaves</span>
    </a>
</li>


<li class="nav-item">
    <a class="nav-link collapsed" href="index_admin.php?page=total_leaves">
        <i class="bi bi-list-task"></i> <!-- Total Leaves Icon -->
        <span>Total Leaves</span>
    </a>
</li>

<li class="nav-item">
    <a class="nav-link collapsed" href="index_admin.php?page=view_employee">
        <i class="bi bi-people"></i> <!-- View Employees Icon -->
        <span>View Employees</span>
    </a>
</li>




      <li class="nav-item">
      <a class="nav-link collapsed" href="logout.php">
        <i class="bi bi-box-arrow-right"></i>
            <span>Logout</span>
          </a>
        </li>

        </ul>

  </aside>  

  <main id="main" class="main">
 

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body">
             
          
                  <?php
        if (isset($_GET['page'])){
            $page=$_GET['page'];

                                            switch ($page){
  

                                              case 'dashboard':
                                                include 'dashboard.php';
                                                break;
                                               
                                              case 'add_employee':
                                                include 'add_employee.php';
                                                break;

                                                case 'approve_leaves':
                                                  include 'approve_leaves.php';
                                                  break;

                                                  case 'pending_leaves':
                                                    include 'pending_leaves.php';
                                                    break;
                                                
                                                    case 'total_leaves':
                                                      include 'total_leaves.php';
                                                      break;

                                                      case 'view_employee':
                                                        include 'view_employee.php';  
                                                        break;

                                                        case 'disapproved':
                                                          include 'disapproved.php';  
                                                          break;
  


                                                        case 'view_employee_details':
                                                          include 'view_employees_details.php';
                                                          break;
  

                                                  
                  
                                          }

                                      }
                                  ?>
            </div>
          </div>

        </div>
      </div>
    </section>

  </main>

  <footer id="footer" class="footer">
    <div class="copyright">
      &copy; Copyright <strong><span>ACT</span></strong>. All Rights Reserved
    </div>
    <div class="credits">

      Designed by <a href="https://www.facebook.com/roysarazojr">Arazo</a>
                  <a href="https://www.facebook.com/johnrey.clemena.71"> & Clemena</a>
                  <a href="https://www.facebook.com/rjlouisetan"> & Tan</a>
    </div>
  </footer>

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <script src="assets/vendor/apexcharts/apexcharts.min.js"></script>
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/chart.js/chart.umd.js"></script>
  <script src="assets/vendor/echarts/echarts.min.js"></script>
  <script src="assets/vendor/quill/quill.js"></script>
  <script src="assets/vendor/simple-datatables/simple-datatables.js"></script>
  <script src="assets/vendor/tinymce/tinymce.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>


  <script src="assets/js/main.js"></script>

</body>

</html>