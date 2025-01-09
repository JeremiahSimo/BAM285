<?php
include 'includes/connection.php';

// Handle delete action
if (isset($_POST["btn_delete"])) {
    $delete_id = $_POST['delete_attendance_id'];

    // Update delete status in the database
    $delete_query = "UPDATE `attendance` SET `delete_status` = 1 WHERE id = $delete_id";
    $result = $conn->query($delete_query) or die($conn->error);
}

// Handle edit action
if (isset($_POST['btn_edit'])) {
    $edit_id = $_POST['edit_attendance_id'];
    $date = $_POST['edit_date'];
    $child_id = $_POST['edit_child_id'];
    $check_in = $_POST['edit_check_in'];
    $check_out = $_POST['edit_check_out'];
    $attendance_status = $_POST['edit_attendance_status'];

    // Update record in the database
    $edit_query = "UPDATE `attendance` SET 
        date = '$date',
        child_id = '$child_id',
        check_in = '$check_in',
        check_out = '$check_out',
        attendance_status = '$attendance_status'
        WHERE id = $edit_id";

    $result = $conn->query($edit_query) or die($conn->error);
}

// Fetch all attendance records where delete_status is 0
$query = "SELECT * FROM `attendance` WHERE delete_status = 0";
$result = $conn->query($query) or die($conn->error);
?>

<table class="table datatable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Child ID</th>
            <th>Check In</th>
            <th>Check Out</th>
            <th>Attendance Status</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['date']; ?></td>
                <td><?php echo $row['child_id']; ?></td>
                <td><?php echo $row['check_in']; ?></td>
                <td><?php echo $row['check_out']; ?></td>
                <td><?php echo $row['attendance_status']; ?></td>
                <td>
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">EDIT</button>

                    <!-- Delete Form -->
                    <form method="POST" action="" onsubmit="return confirmDelete();" style="display:inline;">
                        <input type="hidden" name="delete_attendance_id" value="<?php echo $row['id']; ?>">
                        <button type="submit" name="btn_delete" class="btn btn-danger">DELETE</button>
                    </form>
                </td>
            </tr>

            <!-- Edit Modal -->
            <div class="modal fade" id="editModal<?php echo $row['id']; ?>" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <form method="POST" action="">
                            <div class="modal-header">
                                <h5 class="modal-title" id="editModalLabel">Edit Attendance Record</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="edit_attendance_id" value="<?php echo $row['id']; ?>">
                                <div class="mb-3">
                                    <label for="edit_date" class="form-label">Date</label>
                                    <input type="date" class="form-control" id="edit_date" name="edit_date" value="<?php echo $row['date']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_child_id" class="form-label">Child ID</label>
                                    <input type="text" class="form-control" id="edit_child_id" name="edit_child_id" value="<?php echo $row['child_id']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_check_in" class="form-label">Check In</label>
                                    <input type="time" class="form-control" id="edit_check_in" name="edit_check_in" value="<?php echo $row['check_in']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_check_out" class="form-label">Check Out</label>
                                    <input type="time" class="form-control" id="edit_check_out" name="edit_check_out" value="<?php echo $row['check_out']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_attendance_status" class="form-label">Attendance Status</label>
                                    <select class="form-control" id="edit_attendance_status" name="edit_attendance_status" required>
                                        <option value="Present" <?php echo $row['attendance_status'] == 'Present' ? 'selected' : ''; ?>>Present</option>
                                        <option value="Absent" <?php echo $row['attendance_status'] == 'Absent' ? 'selected' : ''; ?>>Absent</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" name="btn_edit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </tbody>
</table>

<script>
    function confirmDelete() {
        return confirm("Are you sure you want to delete this record?");
    }
</script>
