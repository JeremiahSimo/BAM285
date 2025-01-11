<?php
include 'connection.php';

// Check if the user is logged in
if (!isset($_SESSION['email'])) {
    echo "<script>alert('Please log in first'); window.location.href='index.php';</script>";
    exit();
}
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<section id="post">
    <div class="container">
        <div class="row">
            <table class="table table-bordered table-hover table-striped">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Department</th>
                        <th>Leave Date</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    // Fetch leaves data for the logged-in user
                    $sql = "SELECT * FROM leaves WHERE email='" . $_SESSION['email'] . "'";
                    $que = mysqli_query($con, $sql);
                    $cnt = 1;
                    while ($result = mysqli_fetch_assoc($que)) {
                        ?>
                        <tr>
                            <td><?php echo $cnt; ?></td>
                            <td><?php echo $result['name']; ?></td>
                            <td><?php echo $result['department']; ?></td>
                            <td><?php echo $result['leavedate']; ?></td>
                            <td><?php echo $result['leavereason']; ?></td>
                            <td>
                                <?php 
                                // Display status with proper labels and icons
                                if ($result['status'] == 0) {
                                    echo "<span class='badge badge-warning text-dark'>
                                            <i class='fas fa-circle' style='color: orange;'></i> Pending
                                          </span>";
                                } elseif ($result['status'] == 1) {
                                    echo "<span class='badge badge-success text-dark'>
                                            <i class='fas fa-circle' style='color: green;'></i> Approved
                                          </span>";
                                } elseif ($result['status'] == 2) {
                                    echo "<span class='badge badge-danger text-dark'>
                                            <i class='fas fa-circle' style='color: red;'></i> Disapproved
                                          </span>";
                                }
                                ?>
                            </td>
                        </tr>
                        <?php 
                        $cnt++;
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
</section>
