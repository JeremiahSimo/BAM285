<?php
include 'connection.php'; // Include the database connection

// Handle "Approve" and "Disapprove" actions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['approve_id'])) {
        $approve_id = $_POST['approve_id'];
        $updateQuery = "UPDATE leaves SET status = 1 WHERE id = ?";
        $stmt = mysqli_prepare($con, $updateQuery);
        mysqli_stmt_bind_param($stmt, "i", $approve_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='alert alert-success'>Leave approved successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error approving leave: " . mysqli_error($con) . "</div>";
        }

        mysqli_stmt_close($stmt);
    } elseif (isset($_POST['disapprove_id'])) {
        $disapprove_id = $_POST['disapprove_id'];
        $updateQuery = "UPDATE leaves SET status = 2 WHERE id = ?";
        $stmt = mysqli_prepare($con, $updateQuery);
        mysqli_stmt_bind_param($stmt, "i", $disapprove_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='alert alert-success'>Leave disapproved successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error disapproving leave: " . mysqli_error($con) . "</div>";
        }

        mysqli_stmt_close($stmt);
    } elseif (isset($_POST['edit_status_id'])) {
        // Handle status change via modal
        $edit_status_id = $_POST['edit_status_id'];
        $new_status = $_POST['status'];
        $updateQuery = "UPDATE leaves SET status = ? WHERE id = ?";
        $stmt = mysqli_prepare($con, $updateQuery);
        mysqli_stmt_bind_param($stmt, "ii", $new_status, $edit_status_id);

        if (mysqli_stmt_execute($stmt)) {
            echo "<div class='alert alert-success'>Leave status updated successfully!</div>";
        } else {
            echo "<div class='alert alert-danger'>Error updating status: " . mysqli_error($con) . "</div>";
        }

        mysqli_stmt_close($stmt);
    }
}
?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

<div class="container mt-5">
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card">
                <div class="card-header bg-success text-white">
                    <h5>Leave Requests</h5>
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
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM leaves";
                            $result = mysqli_query($con, $sql);
                            $cnt = 1;

                            while ($row = mysqli_fetch_assoc($result)) {
                                if ($row['status'] == 1) {
                                    $status = "<span class='badge badge-success text-dark'><i class='fas fa-circle' style='color: green;'></i> Approved</span>";
                                } elseif ($row['status'] == 2) {
                                    $status = "<span class='badge badge-danger text-dark'><i class='fas fa-circle' style='color: red;'></i> Disapproved</span>";
                                } else {
                                    $status = "<span class='badge badge-warning text-dark'><i class='fas fa-circle' style='color: orange;'></i> Pending</span>";
                                }

                                $actionButtons = "";
                                if ($row['status'] == 0) { // Pending status
                                    $actionButtons = "
                                        <div class='d-flex justify-content-around'>
                                            <form method='POST' style='display:inline;'>
                                                <input type='hidden' name='approve_id' value='{$row['id']}'>
                                                <button type='submit' class='btn btn-success btn-sm'>Approve</button>
                                            </form>
                                            <form method='POST' style='display:inline;'>
                                                <input type='hidden' name='disapprove_id' value='{$row['id']}'>
                                                <button type='submit' class='btn btn-danger btn-sm'>Disapprove</button>
                                            </form>
                                        </div>";
                                } elseif ($row['status'] == 2) { // Disapproved status
                                    $actionButtons = "
                                        <button class='btn btn-primary btn-sm' data-bs-toggle='modal' data-bs-target='#editModal{$row['id']}'>Edit</button>";
                                }

                                echo "<tr>
                                    <td>{$cnt}</td>
                                    <td>{$row['name']}</td>
                                    <td>{$row['department']}</td>
                                    <td>{$row['leavedate']}</td>
                                    <td>{$row['leavereason']}</td>
                                    <td>{$status}</td>
                                    <td>{$actionButtons}</td>
                                </tr>";

                                // Modal for editing status
                                echo "
                                    <div class='modal fade' id='editModal{$row['id']}' tabindex='-1' aria-labelledby='editModalLabel' aria-hidden='true'>
                                        <div class='modal-dialog'>
                                            <div class='modal-content'>
                                                <div class='modal-header'>
                                                    <h5 class='modal-title' id='editModalLabel'>Edit Leave Status</h5>
                                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                                </div>
                                                <form method='POST'>
                                                    <div class='modal-body'>
                                                        <input type='hidden' name='edit_status_id' value='{$row['id']}'>
                                                        <div class='mb-3'>
                                                            <label for='status' class='form-label'>Status</label>
                                                            <select class='form-control' name='status' required>
                                                                <option value='1' " . ($row['status'] == 1 ? 'selected' : '') . ">Approved</option>
                                                                <option value='2' " . ($row['status'] == 2 ? 'selected' : '') . ">Disapproved</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class='modal-footer'>
                                                        <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                                        <button type='submit' class='btn btn-primary'>Save Changes</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>";
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
