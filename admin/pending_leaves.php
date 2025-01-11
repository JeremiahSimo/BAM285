<?php
include 'connection.php'; // Include database connection

// Function to get all pending leaves
function getPendingLeaves($con) {
    $query = "SELECT * FROM leaves WHERE status = 0";
    $result = mysqli_query($con, $query);
    return mysqli_fetch_all($result, MYSQLI_ASSOC);
}

// Function to approve a leave
function approveLeave($leaveId, $con) {
    $query = "UPDATE leaves SET status = 1 WHERE id = $leaveId";
    return mysqli_query($con, $query);
}

// Handle Approve Request
if (isset($_GET['approve_id'])) {
    $approve_id = intval($_GET['approve_id']);
    if (approveLeave($approve_id, $con)) {
        echo "<script>alert('Leave approved successfully!'); window.location.href = 'index_admin.php?page=pending_leaves';</script>";
    } else {
        echo "<script>alert('Failed to approve leave.'); window.location.href = 'index_admin.php?page=pending_leaves';</script>";
    }
}
?>


    <title>Pending Leaves</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10 offset-md-1">
                <div class="card">
                    <div class="card-header bg-warning text-dark">
                        <h5 class="card-title text-center">Pending Leaves</h5>
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
                                $pendingLeaves = getPendingLeaves($con);
                                $cnt = 1;
                                foreach ($pendingLeaves as $leave) {
                                    echo "<tr>
                                        <td>{$cnt}</td>
                                        <td>{$leave['name']}</td>
                                        <td>{$leave['department']}</td>
                                        <td>{$leave['leavedate']}</td>
                                        <td>{$leave['leavereason']}</td>
                                        <td><span class='badge badge-warning text-dark'>Pending</span></td>

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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/js/all.min.js"></script>

