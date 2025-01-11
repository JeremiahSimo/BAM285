<?php
include 'connection.php'; // Include the database connection
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5>Approved Leaves</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
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
                            $sql = "SELECT * FROM leaves";
                            $result = mysqli_query($con, $sql);
                            $cnt = 1;

                            while ($row = mysqli_fetch_assoc($result)) {
                                // Define the status badge based on the status value
                                if ($row['status'] == 1) {
                                    $status = "<span class='badge badge-success text-dark'><i class='fas fa-circle' style='color: green;'></i> Approved</span>";
                                } elseif ($row['status'] == 2) {
                                    $status = "<span class='badge badge-danger text-dark'><i class='fas fa-circle' style='color: red;'></i> Disapproved</span>";
                                } else {
                                    $status = "<span class='badge badge-warning text-dark'><i class='fas fa-circle' style='color: orange;'></i> Pending</span>";
                                }

                                echo "<tr>
                                    <td>{$cnt}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['department']}</td>
                                    <td>{$row['leavedate']}</td>
                                    <td>{$row['leavereason']}</td>
                                    <td>{$status}</td>
                                </tr>";
                                $cnt++;
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
