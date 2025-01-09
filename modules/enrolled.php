<?php
include 'includes/connection.php';

// Handle delete action
if (isset($_POST["btn_delete"])) {
    $delete_id = $_POST['delete_child_id'];

    // Update delete status in the database
    $delete_query = "UPDATE `children` SET `delete_status` = 1 WHERE id = $delete_id";
    $result = $conn->query($delete_query) or die($conn->error);
}

// Handle edit action
if (isset($_POST['btn_edit'])) {
    $edit_id = $_POST['edit_child_id'];
    $full_name = $_POST['edit_full_name'];
    $date_of_birth = $_POST['edit_date_of_birth'];
    $parent_name = $_POST['edit_parent_name'];
    $contact_info = $_POST['edit_contact_info'];
    $special_notes = $_POST['edit_special_notes'];
    $gender = $_POST['edit_gender'];

    // Update record in the database
    $edit_query = "UPDATE `children` SET 
        full_name = '$full_name',
        date_of_birth = '$date_of_birth',
        parent_name = '$parent_name',
        contact_info = '$contact_info',
        special_notes = '$special_notes',
        gender = '$gender'
        WHERE id = $edit_id";

    $result = $conn->query($edit_query) or die($conn->error);
}

// Fetch all children where delete_status is 0
$query = "SELECT *, TIMESTAMPDIFF(YEAR, date_of_birth, CURDATE()) AS age FROM `children` WHERE delete_status = 0";
$result = $conn->query($query) or die($conn->error);
?>

<table class="table datatable">
    <thead>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Birthday</th>
            <th>Guardian</th>
            <th>Contact Info/Email</th>
            <th>Special Notes</th>
            <th>Age</th>
            <th>Gender</th>
            <th colspan="2">Action</th>
        </tr>
    </thead>
    <tbody>
        <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['full_name']; ?></td>
                <td><?php echo $row['date_of_birth']; ?></td>
                <td><?php echo $row['parent_name']; ?></td>
                <td><?php echo $row['contact_info']; ?></td>
                <td><?php echo $row['special_notes']; ?></td>
                <td><?php echo $row['age']; ?></td>
                <td><?php echo $row['gender']; ?></td>
                <td>
                    <!-- Edit Button -->
                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#editModal<?php echo $row['id']; ?>">EDIT</button>

                    <!-- Delete Form -->
                    <form method="POST" action="" onsubmit="return confirmDelete();" style="display:inline;">
                        <input type="hidden" name="delete_child_id" value="<?php echo $row['id']; ?>">
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
                                <h5 class="modal-title" id="editModalLabel">Edit Child Information</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="edit_child_id" value="<?php echo $row['id']; ?>">
                                <div class="mb-3">
                                    <label for="edit_full_name" class="form-label">Full Name</label>
                                    <input type="text" class="form-control" id="edit_full_name" name="edit_full_name" value="<?php echo $row['full_name']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_date_of_birth" class="form-label">Date of Birth</label>
                                    <input type="date" class="form-control" id="edit_date_of_birth" name="edit_date_of_birth" value="<?php echo $row['date_of_birth']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_parent_name" class="form-label">Guardian</label>
                                    <input type="text" class="form-control" id="edit_parent_name" name="edit_parent_name" value="<?php echo $row['parent_name']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_contact_info" class="form-label">Contact Info/Email</label>
                                    <input type="text" class="form-control" id="edit_contact_info" name="edit_contact_info" value="<?php echo $row['contact_info']; ?>" required>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_special_notes" class="form-label">Special Notes</label>
                                    <textarea class="form-control" id="edit_special_notes" name="edit_special_notes" required><?php echo $row['special_notes']; ?></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="edit_gender" class="form-label">Gender</label>
                                    <select class="form-control" id="edit_gender" name="edit_gender" required>
                                        <option value="Male" <?php echo $row['gender'] == 'Male' ? 'selected' : ''; ?>>Male</option>
                                        <option value="Female" <?php echo $row['gender'] == 'Female' ? 'selected' : ''; ?>>Female</option>
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
