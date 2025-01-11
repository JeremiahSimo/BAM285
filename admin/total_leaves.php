<?php
include 'connection.php'; // Include database connection

function getApprovedLeaves($con) {
    $query = "SELECT * FROM leaves WHERE status = 1"; // Filter only approved leaves
    $result = mysqli_query($con, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}
?>

<title>Total Approved Leaves</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header bg-info text-white">
                    <h5 class="card-title text-center">Total Approved Leaves</h5>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Department</th>
                                <th>Date</th>
                                <th>Reason</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $leaves = getApprovedLeaves($con);
                            $cnt = 1;
                            foreach ($leaves as $leave) {
                                $status = "<span class='badge badge-success text-dark'><i class='fas fa-circle' style='color: green;'></i> Approved</span>";

                                echo "<tr>
                                    <td>{$cnt}</td>
                                    <td>{$leave['name']}</td>
                                    <td>{$leave['department']}</td>
                                    <td>{$leave['leavedate']}</td>
                                    <td>{$leave['leavereason']}</td>
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
