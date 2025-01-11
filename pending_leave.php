<?php
include 'connection.php'; // Include the database connection
?>

    <title>Pending Leaves</title>
    <style>
    .badge-warning {
        color: black !important;
        font-style:normal !important;
    }
    </style>


    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header bg-warning text-white">
                        <h5>Pending Leaves</h5>
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
                                $sql = "SELECT * FROM leaves WHERE status = 0";
                                $result = mysqli_query($con, $sql);
                                $cnt = 1;
                                while ($row = mysqli_fetch_assoc($result)) {
                                    echo "<tr>
                                        <td>{$cnt}</td>
                                        <td>{$row['name']}</td>
                                        <td>{$row['department']}</td>
                                        <td>{$row['leavedate']}</td>
                                        <td>{$row['leavereason']}</td>
                                        <td><span class='badge badge-warning'>Pending</span></td>

                                       
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
