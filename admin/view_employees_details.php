<?php
include 'connection.php'; // Include the database connection

// Check if employee_id is passed
if (isset($_GET['employee_id'])) {
    $employee_id = $_GET['employee_id'];

    // Fetch employee details
    $queryEmployee = "SELECT * FROM users WHERE id = ?";
    $stmtEmployee = mysqli_prepare($con, $queryEmployee);
    mysqli_stmt_bind_param($stmtEmployee, "i", $employee_id);
    mysqli_stmt_execute($stmtEmployee);
    $resultEmployee = mysqli_stmt_get_result($stmtEmployee);
    $employee = mysqli_fetch_assoc($resultEmployee);

    // Fetch employee leave details
    $queryLeaves = "SELECT * FROM leaves WHERE email = ?";
    $stmtLeaves = mysqli_prepare($con, $queryLeaves);
    mysqli_stmt_bind_param($stmtLeaves, "s", $employee['email']);
    mysqli_stmt_execute($stmtLeaves);
    $resultLeaves = mysqli_stmt_get_result($stmtLeaves);
    $leaves = mysqli_fetch_all($resultLeaves, MYSQLI_ASSOC);
} else {
    // Redirect to the employees list if no employee_id is provided
    header("Location: view_employee.php");
    exit();
}
?>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Employee Details</title>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Employee Details</h4>
        </div>
        <div class="card-body">
            <h5 class="mb-3">Personal Information</h5>
            <p><strong>Name:</strong> <?php echo $employee['name']; ?></p>
            <p><strong>Department:</strong> <?php echo $employee['department']; ?></p>
            <p><strong>Email:</strong> <?php echo $employee['email']; ?></p>

            <hr>

            <h5 class="mb-3">Leave Details</h5>
            <?php if (!empty($leaves)): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Leave Date</th>
                        <th>Reason</th>
                        <th>Status</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $cnt = 1; ?>
                    <?php foreach ($leaves as $leave): ?>
                        <tr>
                            <td><?php echo $cnt++; ?></td>
                            <td><?php echo $leave['leavedate']; ?></td>
                            <td><?php echo $leave['leavereason']; ?></td>
                            <td>
                                <?php
                                if ($leave['status'] == 0) {
                                    echo "<span class='badge bg-warning text-dark'>Pending</span>";
                                } elseif ($leave['status'] == 1) {
                                    echo "<span class='badge bg-success text-dark'>Approved</span>";
                                } elseif ($leave['status'] == 2) {
                                    echo "<span class='badge bg-danger text-dark'>Disapproved</span>";
                                }
                                ?>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-center">No leaves found for this employee.</p>
            <?php endif; ?>
        </div>
        <div class="card-footer text-center">
            <a href="index_admin.php?page=view_employee" class="btn btn-secondary">Back to Employee List</a>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
